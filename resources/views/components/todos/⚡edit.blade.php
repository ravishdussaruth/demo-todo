<?php

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Todo $todo;

    #[Validate('required|string|max:255')]
    public string $title = '';

    public bool $updated = false;

    public function mount(Todo $todo): void
    {
        $this->todo = $todo;
        $this->title = $todo->title;
    }

    public function save(): void
    {
        $this->updated = false;

        $this->validate();

        // The bound $todo was resolved at mount(); re-verify it still exists
        // in case it was deleted elsewhere between then and this submission.
        Todo::findOrFail($this->todo->id)->update([
            'title' => $this->title,
        ]);

        $this->updated = true;
    }
};
?>

<div>
    <h1>Edit Todo</h1>

    @if ($updated)
        <p data-testid="todo-updated-message">Todo updated successfully.</p>
    @endif

    <form wire:submit="save">
        <label for="title">Title</label>
        <input type="text" id="title" wire:model="title">
        @error('title')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">Save</button>
    </form>
</div>
