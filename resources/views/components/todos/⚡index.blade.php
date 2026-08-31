<?php

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function todos(): Collection
    {
        return Todo::query()->orderBy('id')->get();
    }

    public function toggleCompleted(int $todoId): void
    {
        $todo = Todo::findOrFail($todoId);

        $todo->update(['completed' => ! $todo->completed]);

        unset($this->todos);
    }
};
?>

<div>
    <h1>Todos</h1>

    @if ($this->todos->isEmpty())
        <p data-testid="todos-empty-state">No todos yet.</p>
    @else
        <ul data-testid="todos-list">
            @foreach ($this->todos as $todo)
                <li wire:key="todo-{{ $todo->id }}">
                    {{ $todo->title }} — {{ $todo->completed ? 'Completed' : 'Incomplete' }}

                    <button type="button" wire:click="toggleCompleted({{ $todo->id }})">
                        {{ $todo->completed ? 'Reopen' : 'Mark complete' }}
                    </button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
