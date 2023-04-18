<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ComplaintType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComplaintType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];
    }
}
