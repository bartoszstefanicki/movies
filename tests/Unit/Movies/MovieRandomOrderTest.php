<?php

namespace Tests\Unit\Movies;

use Domain\Movies\Services\MovieService;

class MovieRandomOrderTest extends MovieTestAbstract
{
    public function test_limit(): void
    {
        $service = app(MovieService::class);
        $randomNumber = rand(1, 25);

        $this->assertTrue(
            count($service->allWithRandomOrder($randomNumber)) === $randomNumber
        );
    }

    public function test_exception_on_larger_limit_than_number_of_movies(): void
    {
        $service = app(MovieService::class);
        $moviesCount = count($service->all());

        $this->expectException(\Exception::class);
        $service->allWithRandomOrder($moviesCount + 1);
    }

    public function test_random_order(): void
    {
        $service = app(MovieService::class);
        $randomNumber = rand(1, 25);

        $firstArray = $service->allWithRandomOrder($randomNumber);
        $secondArray = $service->allWithRandomOrder($randomNumber);

        $this->assertNotEquals($firstArray, $secondArray);
    }
}
