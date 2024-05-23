<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actorsCount = mt_rand(10, 20);
        $actors = [];
        for ($i = 0; $i < $actorsCount; $i++) {
        $actors[] = $this->faker->name;
        }

        $aliases = ['butterfly.jpg', 'fei-ying.jpg', 'fifth-element.jpg', 'ivan-vasilievich.png', 'leon.jpg', 'lock-stock.jpg', 'manhattan-melodrama.jpg', 'rush-hour.jpg', 'rush-hour-2.jpg', 'scary-movie.png', 'scary-movie-2.png', 'schindler-list.jpg', 'snatch.jpg', 'spartak.jpg', 'this-war.jpg', 'who-am-i.jpg'];

        return [
            'title' => $this->faker->realText(mt_rand(20, 100)),
            'release_year' => mt_rand(1980, 2010),
            'genre_id' => $this->faker->numberBetween(1, 5),
            'country' => $this->faker->country,
            'director' => $this->faker->name,
            'duration' => sprintf('%02d:%02d:%02d', mt_rand(1, 4), mt_rand(0, 59), mt_rand(0, 59)),
            'actors' => implode(', ', $actors),
            'price' => mt_rand(200, 800),
            'description' => $this->getFakeHTMLText(mt_rand(2, 4)),
            'cover' => $aliases[mt_rand(0, 15)]
        ];
    }

    public function getFakeHTMLText($countParagraphs) {
        $paragraphs = $this->faker->paragraphs($countParagraphs);
        $text = '';
        foreach ($paragraphs as $p) {
            $text .= $p.'<br>';
        }
        return $text;
    }

}
