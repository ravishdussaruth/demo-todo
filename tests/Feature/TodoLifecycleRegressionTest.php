<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * End-to-end regression pass tying the whole Todo feature set together:
 * create -> list -> edit -> complete -> reopen -> filter/search -> delete.
 */
class TodoLifecycleRegressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_todo_lifecycle_behaves_correctly_end_to_end(): void
    {
        // Create.
        Livewire::test('todos.create-todo')
            ->set('title', 'Buy milk')
            ->call('save')
            ->assertHasNoErrors();

        $todo = Todo::sole();
        $this->assertSame('Buy milk', $todo->title);
        $this->assertFalse($todo->completed);

        // List.
        Livewire::test('todos.index')
            ->assertSee('Buy milk')
            ->assertSee('Incomplete');

        // Edit.
        Livewire::test('todos.edit', ['todo' => $todo])
            ->set('title', 'Buy oat milk')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('Buy oat milk', $todo->fresh()->title);

        // Complete.
        Livewire::test('todos.index')
            ->call('toggleCompleted', $todo->id)
            ->assertSee('Completed');

        $this->assertTrue($todo->fresh()->completed);

        // Filter by status.
        Livewire::test('todos.index')
            ->set('status', 'completed')
            ->assertSee('Buy oat milk')
            ->set('status', 'incomplete')
            ->assertDontSee('Buy oat milk');

        // Reopen.
        Livewire::test('todos.index')
            ->call('toggleCompleted', $todo->id)
            ->assertSee('Incomplete');

        $this->assertFalse($todo->fresh()->completed);

        // Search.
        Livewire::test('todos.index')
            ->set('search', 'oat')
            ->assertSee('Buy oat milk')
            ->set('search', 'nonexistent')
            ->assertDontSee('Buy oat milk');

        // Delete.
        Livewire::test('todos.index')
            ->call('deleteTodo', $todo->id)
            ->assertSee('No todos yet.');

        $this->assertSame(0, Todo::count());
    }
}
