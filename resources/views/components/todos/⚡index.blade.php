<?php

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public string $status = 'all';

    public string $search = '';

    #[Computed]
    public function todos(): Collection
    {
        return Todo::query()
            ->when($this->status === 'completed', fn ($query) => $query->where('completed', true))
            ->when($this->status === 'incomplete', fn ($query) => $query->where('completed', false))
            ->when($this->search !== '', fn ($query) => $query->where('title', 'like', '%'.$this->search.'%'))
            ->orderBy('id')
            ->get();
    }

    public function toggleCompleted(int $todoId): void
    {
        $todo = Todo::findOrFail($todoId);

        $todo->update(['completed' => ! $todo->completed]);

        unset($this->todos);
    }

    public function deleteTodo(int $todoId): void
    {
        Todo::findOrFail($todoId)->delete();

        unset($this->todos);
    }
};
?>

<div>
    <h1>Todos</h1>

    <label for="search">Search</label>
    <input type="text" id="search" wire:model.live="search" placeholder="Search by title">

    <label for="status">Status</label>
    <select id="status" wire:model.live="status">
        <option value="all">All</option>
        <option value="incomplete">Incomplete</option>
        <option value="completed">Completed</option>
    </select>

    @if ($this->todos->isEmpty())
        @if ($status === 'all' && $search === '')
            <p data-testid="todos-empty-state">No todos yet.</p>
        @else
            <p data-testid="todos-no-matches">No todos match your filters.</p>
        @endif
    @else
        <ul data-testid="todos-list">
            @foreach ($this->todos as $todo)
                <li wire:key="todo-{{ $todo->id }}">
                    {{ $todo->title }} — {{ $todo->completed ? 'Completed' : 'Incomplete' }}

                    <button type="button" wire:click="toggleCompleted({{ $todo->id }})">
                        {{ $todo->completed ? 'Reopen' : 'Mark complete' }}
                    </button>

                    <button type="button" wire:click="deleteTodo({{ $todo->id }})">
                        Delete
                    </button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
