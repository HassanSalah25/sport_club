<?php

namespace Database\Factories;
use App\Models\Branchs;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchsFactory extends Factory
{
    protected $model = Branchs::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'landline' => rand(111111,999999),
            'phone' => rand(1,10000),
            'city' => Str::random(10),
            'address' => Str::random(10),
            'location' => Str::random(50),
        ];
    }
}
