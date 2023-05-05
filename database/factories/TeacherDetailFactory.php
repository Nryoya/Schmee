<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TeacherDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherDetail>
 */
class TeacherDetailFactory extends Factory
{
    /**
     * このファクトリに対応するモデル名
     *
     * @var string
     */
    protected $model = TeacherDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'users_id' => 14,
            'jobs' => '担任',
            'grade' => random_int(1, 3),
            'class' => random_int(1, 3),
            'introduction' => fake()->text(),
        ];
    }
}
