<?php

namespace Database\Factories;

use App\Models\Timetable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TimetableFactory extends Factory
{
    protected $model = Timetable::class;

    public function definition()
    {
        return [
			'users_id' => $this->faker->name,
			'date' => $this->faker->name,
			'in_time' => $this->faker->name,
			'out_time' => $this->faker->name,
        ];
    }
}
