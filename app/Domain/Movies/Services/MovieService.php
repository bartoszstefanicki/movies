<?php

namespace Domain\Movies\Services;

use Domain\Movies\Queries\AllMovieQuery;

class MovieService
{
    public function all(): array
    {
        return (new AllMovieQuery())->get();
    }

    public function allWithRandomOrder(int $limit): array
    {
        $movies = $this->all();

        if (count($movies) < $limit) {
            throw new \Exception('Your limit exceeds the number of movies.');
        }

        $randomMovies = [];
        $randomKeys = (array) array_rand($movies, $limit);

        foreach ($randomKeys as $randomKey) {
            $randomMovies[] = $movies[$randomKey];
        }

        return $randomMovies;
    }

    public function allWithEvenTitleAndStartingWithLetter(string $letter): array
    {
        $movies = $this->all();

        if (strlen($letter) > 1) {
            throw new \Exception('You entered more then one letter.');
        }

        $filteredMovies = array_filter($movies, function ($movie) use ($letter) {
            return strlen($movie) % 2 === 0
                && substr($movie, 0, 1) === $letter;
        });

        return array_values($filteredMovies);
    }

    public function allWithWordsInTitle(): array
    {
        $movies = $this->all();
        $filteredMovies = [];

        foreach ($movies as $movie) {
            $wordsInTitle = explode(' ', $movie);

            if (count($wordsInTitle) < 2) {
                continue;
            }

            $wordsWithMoreThanTwoLetters = array_filter($wordsInTitle, function ($word) {
                return strlen($word) >= 2;
            });

            if (count($wordsWithMoreThanTwoLetters) < 2) {
                continue;
            }

            $filteredMovies[] = $movie;
        }

        return array_values($filteredMovies);
    }
}
