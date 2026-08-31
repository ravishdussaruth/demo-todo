<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeLivewire('todos.index');
    }

    public function test_existing_todos_are_rendered(): void
    {
        $completed = Todo::factory()->create(['title' => 'Buy milk', 'completed' => true]);
        $incomplete = Todo::factory()->create(['title' => 'Read a book', 'completed' => false]);

        Livewire::test('todos.index')
            ->assertSee('Buy milk')
            ->assertSee('Completed')
            ->assertSee('Read a book')
            ->assertSee('Incomplete')
            ->assertDontSee('No todos yet.');

        $this->assertTrue($completed->exists);
        $this->assertTrue($incomplete->exists);
    }

    public function test_empty_state_is_shown_when_no_todos_exist(): void
    {
        Livewire::test('todos.index')
            ->assertSee('No todos yet.')
            ->assertDontSeeHtml('data-testid="todos-list"');
    }
}
