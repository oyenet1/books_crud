<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $author = $this->faker->name;
        return [
            'title' => $this->faker->sentence(5),
            'author' => $author,
            'publication_year' => date('Y') - random_int(1, 36)
        ];
    }
}