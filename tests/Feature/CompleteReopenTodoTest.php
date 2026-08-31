<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteReopenTodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_marking_an_incomplete_todo_complete_persists_and_reflects_new_state(): void
    {
        $todo = Todo::factory()->create(['completed' => false]);

        Livewire::test('todos.index')
            ->call('toggleCompleted', $todo->id)
            ->assertSee('Completed')
            ->assertSee('Reopen');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'completed' => true,
        ]);
    }

    public function test_reopening_a_completed_todo_persists_and_reflects_new_state(): void
    {
        $todo = Todo::factory()->create(['completed' => true]);

        Livewire::test('todos.index')
            ->call('toggleCompleted', $todo->id)
            ->assertSee('Incomplete')
            ->assertSee('Mark complete');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'completed' => false,
        ]);
    }

    public function test_toggling_one_todo_does_not_affect_others(): void
    {
        $target = Todo::factory()->create(['completed' => false]);
        $other = Todo::factory()->create(['completed' => false]);

        Livewire::test('todos.index')
            ->call('toggleCompleted', $target->id);

        $this->assertDatabaseHas('todos', ['id' => $target->id, 'completed' => true]);
        $this->assertDatabaseHas('todos', ['id' => $other->id, 'completed' => false]);
    }

    public function test_toggling_a_nonexistent_todo_throws_not_found(): void
    {
        $this->expectException(ModelNotFoundException::class);

        Livewire::test('todos.index')
            ->call('toggleCompleted', 999999);
    }
}
