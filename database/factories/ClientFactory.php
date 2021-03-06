<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $fakeID = 0;
        return [
            'cla_frist_name'=>$this->faker->firstName(),
            'cla_last_name' => $this->faker->name(),
            'cla_img'=>$this->faker->image(),
            'cla_phone_num' => $this->faker->phoneNumber,
            'cla_email'=> $this->faker->unique()->safeEmail(),
            'state' => $this->faker->boolean(50),
            'fakeID' => ++$fakeID,
        ];
    }
}
