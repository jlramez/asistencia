<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'on' => $this->faker->name,
			'out' => $this->faker->name,
			'tolerance' => $this->faker->name,
			'active' => $this->faker->name,
        ];
    }
}
