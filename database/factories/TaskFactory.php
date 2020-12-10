<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::get();
        $userIds = $users->pluck('id');
        $userId = $userIds[rand(0, count($userIds) - 1)];

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(3, true),
            'status' => $this->faker->boolean,
            'user_id' => $userId,
        ];
    }
}
