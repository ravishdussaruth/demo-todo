<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_a_todo_removes_it_from_persistence(): void
    {
        $todo = Todo::factory()->create();

        Livewire::test('todos.index')
            ->call('deleteTodo', $todo->id);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
        $this->assertSame(0, Todo::count());
    }

    public function test_deleted_todo_no_longer_appears_in_the_list(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        Livewire::test('todos.index')
            ->call('deleteTodo', $todo->id)
            ->assertDontSee('Buy milk')
            ->assertSee('No todos yet.');
    }

    public function test_deleting_one_todo_does_not_remove_others(): void
    {
        $target = Todo::factory()->create();
        $other = Todo::factory()->create();

        Livewire::test('todos.index')
            ->call('deleteTodo', $target->id);

        $this->assertDatabaseMissing('todos', ['id' => $target->id]);
        $this->assertDatabaseHas('todos', ['id' => $other->id]);
    }

    public function test_deleting_a_nonexistent_todo_throws_not_found(): void
    {
        $this->expectException(ModelNotFoundException::class);

        Livewire::test('todos.index')
            ->call('deleteTodo', 999999);
    }
}
