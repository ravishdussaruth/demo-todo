<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditTodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_page_is_accessible_for_an_existing_todo(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        $response = $this->get("/todos/{$todo->id}/edit");

        $response->assertStatus(200);
        $response->assertSeeLivewire('todos.edit');
        $response->assertSee('Buy milk');
    }

    public function test_valid_title_updates_the_todo(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        Livewire::test('todos.edit', ['todo' => $todo])
            ->set('title', 'Buy oat milk')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSee('Todo updated successfully.');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Buy oat milk',
        ]);
    }

    public function test_blank_title_fails_validation_and_does_not_update(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        Livewire::test('todos.edit', ['todo' => $todo])
            ->set('title', '')
            ->call('save')
            ->assertHasErrors(['title' => ['required']]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Buy milk',
        ]);
    }

    public function test_title_over_255_characters_fails_validation(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        Livewire::test('todos.edit', ['todo' => $todo])
            ->set('title', str_repeat('a', 256))
            ->call('save')
            ->assertHasErrors(['title' => ['max']]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Buy milk',
        ]);
    }

    public function test_editing_a_nonexistent_todo_returns_not_found(): void
    {
        $response = $this->get('/todos/999999/edit');

        $response->assertNotFound();
    }
}
