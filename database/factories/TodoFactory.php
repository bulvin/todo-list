<?php

namespace Database\Factories;

use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional(0.7)->paragraph(),
            'priority' => $this->faker->randomElement(TodoPriority::cases())->value,
            'status' => $this->faker->randomElement(TodoStatus::cases())->value,
            'due_date' => $this->faker->date('Y-m-d', '+1 week'),
        ];
    }
}
