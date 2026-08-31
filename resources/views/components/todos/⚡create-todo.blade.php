<?php

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    public bool $created = false;

    public function save(): void
    {
        $this->validate();

        Todo::create([
            'title' => $this->title,
        ]);

        $this->reset('title');

        $this->created = true;
    }
};
?>

<div>
    <h1>Create Todo</h1>

    @if ($created)
        <p data-testid="todo-created-message">Todo created successfully.</p>
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
