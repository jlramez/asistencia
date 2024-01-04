<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CheckFactory extends Factory
{
    protected $model = Check::class;

    public function definition()
    {
        return [
			'users_id' => $this->faker->name,
			'checktime' => $this->faker->name,
			'date' => $this->faker->name,
			'types_id' => $this->faker->name,
        ];
    }
}
