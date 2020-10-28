<?php

namespace Database\Factories;

use App\Models\UserQr;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserQrFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserQr::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'region'=>$this->faker->address,
            'id_number'=>$this->faker->numberBetween(123456789,912345678)
        ];
    }
}
