<?php

namespace Tests\Unit;

use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\TodoShareToken;
use App\Models\User;
use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TodoService();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testShouldCreateTodoWhenValidDataProvided()
    {
        $data = [
            'name' => 'Test Todo',
            'priority' => TodoPriority::HIGH,
            'status' => TodoStatus::TODO,
            'due_date' => now()->addDay()
        ];

        $todo = $this->service->createTodo($data);

        $this->assertInstanceOf(Todo::class, $todo);
        $this->assertEquals('Test Todo', $todo->name);
        $this->assertEquals($this->user->id, $todo->user_id);
    }

    public function testShouldDeleteTodoWhenTodoExists()
    {
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);

        $result = $this->service->deleteTodo($todo->id);

        $this->assertTrue($result);
        $this->assertNull(Todo::find($todo->id));
    }

    public function testShouldUpdateTodoWhenValidDataProvided()
    {
        $todo = Todo::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'Old Name'
        ]);

        $updatedTodo = $this->service->updateTodo($todo->id, ['name' => 'New Name']);

        $this->assertEquals('New Name', $updatedTodo->name);
    }

    public function testShouldRetrievePublicTodoWhenValidTokenProvided()
    {
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);
        $token = TodoShareToken::createForTodo($todo->id, 48);

        $retrievedTodo = $this->service->getPublicTodoByToken($token->token);

        $this->assertEquals($todo->id, $retrievedTodo->id);
    }
}
