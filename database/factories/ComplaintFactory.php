<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text,
            'user_id' => \App\Models\User::factory(),
            'municipality_id' => \App\Models\Municipality::factory(),
        ];
    }
}
