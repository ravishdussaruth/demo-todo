<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilterAndSearchTodosTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_filter_shows_only_completed_todos(): void
    {
        Todo::factory()->create(['title' => 'Buy milk', 'completed' => true]);
        Todo::factory()->create(['title' => 'Read a book', 'completed' => false]);

        Livewire::test('todos.index')
            ->set('status', 'completed')
            ->assertSee('Buy milk')
            ->assertDontSee('Read a book');
    }

    public function test_status_filter_shows_only_incomplete_todos(): void
    {
        Todo::factory()->create(['title' => 'Buy milk', 'completed' => true]);
        Todo::factory()->create(['title' => 'Read a book', 'completed' => false]);

        Livewire::test('todos.index')
            ->set('status', 'incomplete')
            ->assertSee('Read a book')
            ->assertDontSee('Buy milk');
    }

    public function test_search_filters_by_title_substring(): void
    {
        Todo::factory()->create(['title' => 'Buy milk']);
        Todo::factory()->create(['title' => 'Read a book']);

        Livewire::test('todos.index')
            ->set('search', 'milk')
            ->assertSee('Buy milk')
            ->assertDontSee('Read a book');
    }

    public function test_no_match_shows_empty_result_state_without_error(): void
    {
        Todo::factory()->create(['title' => 'Buy milk']);

        Livewire::test('todos.index')
            ->set('search', 'nonexistent')
            ->assertOk()
            ->assertSee('No todos match your filters.')
            ->assertDontSee('Buy milk');
    }

    public function test_clearing_search_restores_full_results(): void
    {
        Todo::factory()->create(['title' => 'Buy milk']);
        Todo::factory()->create(['title' => 'Read a book']);

        Livewire::test('todos.index')
            ->set('search', 'milk')
            ->assertDontSee('Read a book')
            ->set('search', '')
            ->assertSee('Buy milk')
            ->assertSee('Read a book');
    }

    public function test_status_and_search_filters_combine(): void
    {
        Todo::factory()->create(['title' => 'Buy milk', 'completed' => true]);
        Todo::factory()->create(['title' => 'Buy bread', 'completed' => false]);
        Todo::factory()->create(['title' => 'Read a book', 'completed' => true]);

        Livewire::test('todos.index')
            ->set('status', 'completed')
            ->set('search', 'buy')
            ->assertSee('Buy milk')
            ->assertDontSee('Buy bread')
            ->assertDontSee('Read a book');
    }

    public function test_changing_status_filter_updates_results(): void
    {
        Todo::factory()->create(['title' => 'Buy milk', 'completed' => true]);
        Todo::factory()->create(['title' => 'Read a book', 'completed' => false]);

        Livewire::test('todos.index')
            ->set('status', 'completed')
            ->assertSee('Buy milk')
            ->assertDontSee('Read a book')
            ->set('status', 'all')
            ->assertSee('Buy milk')
            ->assertSee('Read a book');
    }
}
