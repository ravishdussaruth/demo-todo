<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_todo_page_is_accessible(): void
    {
        $response = $this->get('/todos/create');

        $response->assertStatus(200);
        $response->assertSeeLivewire('todos.create-todo');
    }

    public function test_valid_title_creates_and_persists_a_todo(): void
    {
        Livewire::test('todos.create-todo')
            ->set('title', 'Buy milk')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('title', '')
            ->assertSee('Todo created successfully.');

        $this->assertDatabaseHas('todos', [
            'title' => 'Buy milk',
            'completed' => false,
        ]);
        $this->assertSame(1, Todo::count());
    }

    public function test_blank_title_fails_validation_and_persists_nothing(): void
    {
        Livewire::test('todos.create-todo')
            ->set('title', '')
            ->call('save')
            ->assertHasErrors(['title' => ['required']]);

        $this->assertSame(0, Todo::count());
    }

    public function test_title_over_255_characters_fails_validation(): void
    {
        Livewire::test('todos.create-todo')
            ->set('title', str_repeat('a', 256))
            ->call('save')
            ->assertHasErrors(['title' => ['max']]);

        $this->assertSame(0, Todo::count());
    }
}
