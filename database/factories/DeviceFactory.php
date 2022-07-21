<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->sentence($nbWords = 2, $variableNbWords = true);
        return [
            'name' => $name,
            'type_id' => Type::all()->random(),
            'status_id' => 3,
            'description' => fake()->paragraph($nbSentences = 10, $variableNbSentences = true),
            'user_id' => null,
            'imgPath' => 'storage/deviceImgs/macbook-pro-m1.png',
            'slug' => Str::slug($name, '-'),
        ];
    }
}
