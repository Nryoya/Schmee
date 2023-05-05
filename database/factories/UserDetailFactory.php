<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserDetailFactory extends Factory
{

    /**
     * このファクトリに対応するモデル名
     *
     * @var string
     */
    protected $model = UserDetail::class;

    function inc() {
        $count = 9;
        for($i = 0; $i < 10; $i++) {
            $count++;
            return $count;
        }
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   

        return [
            //
                'users_id' => $this->inc(),
                'grade' => random_int(1, 3),
                'class' => random_int(1, 3),
                'onething' => 'よろしくお願いします。',
                'tel' => str_replace('-', '', fake()->unique()->phoneNumber()),
                'address' =>  fake()->unique()->address(),
                'emergency' => str_replace('-', '', fake()->unique()->phoneNumber()),
                'relationship' => '母',
        ];
    }
}
