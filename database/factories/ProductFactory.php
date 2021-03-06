<?php

namespace Database\Factories;

use App\Models\measuresIndex;
use App\Models\MediaLibrary;
use App\Models\Product;
use App\Models\SubSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $fakeID = 0;
        return [
            'prod_name' =>$this->faker->firstName,
            'sub_id' =>$this->faker->randomElement(SubSection::pluck('sub_id')->toArray()),
            'prod_price' => $this->faker->randomDigit,
            'prod_avil_amount' => $this->faker->randomDigit,
            'prod_desc_img' => $this->faker->image(),
            'prod_desc_text' => $this->faker->text(),
            'mesu_index_id'=>$this->faker->randomElement(measuresIndex::pluck('mesu_index_id')->toArray()),
            'medl_id' => $this->faker->randomElement(MediaLibrary::pluck('medl_id')->toArray()),
            'state' => $this->faker->boolean(50),
            'fakeID'=> ++$fakeID,
        ];
    }
}
