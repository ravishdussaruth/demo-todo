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
                </li>
            @endforeach
        </ul>
    @endif
</div>
