<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_can_be_created_via_factory_and_persisted(): void
    {
        $todo = Todo::factory()->create(['title' => 'Buy milk']);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Buy milk',
            'completed' => false,
        ]);
    }

    public function test_todo_defaults_to_incomplete(): void
    {
        $todo = Todo::factory()->create();

        $this->assertFalse($todo->completed);
    }

    public function test_todo_completed_is_cast_to_boolean(): void
    {
        $todo = Todo::factory()->create(['completed' => 1]);

        $this->assertIsBool($todo->fresh()->completed);
        $this->assertTrue($todo->fresh()->completed);
    }

    public function test_todo_title_and_completed_are_mass_assignable(): void
    {
        $todo = Todo::create(['title' => 'Read a book', 'completed' => true]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Read a book',
            'completed' => true,
        ]);
    }
}
