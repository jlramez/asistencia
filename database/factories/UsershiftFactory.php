<?php

namespace Database\Factories;

use App\Models\Usershift;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsershiftFactory extends Factory
{
    protected $model = Usershift::class;

    public function definition()
    {
        return [
			'users_id' => $this->faker->name,
			'schedule_id' => $this->faker->name,
        ];
    }
}
