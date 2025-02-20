<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'domain_id' => Domain::factory(),
        ];
    }
}