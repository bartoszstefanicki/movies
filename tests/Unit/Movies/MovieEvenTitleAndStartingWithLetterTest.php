<?php

namespace Tests\Unit\Movies;

use Domain\Movies\Services\MovieService;

class MovieEvenTitleAndStartingWithLetterTest extends MovieTestAbstract
{
    public function test_more_than_one_letter(): void
    {
        $service = app(MovieService::class);

        $this->expectException(\Exception::class);
        $service->allWithEvenTitleAndStartingWithLetter(letter: 'ABC');
    }

    public function test_equals(): void
    {
        $service = app(MovieService::class);
        $results = $service->allWithEvenTitleAndStartingWithLetter(letter: 'W');

        $this->assertEquals($results, [
            'Whiplash',
            'Wyspa tajemnic',
            'Władca Pierścieni: Drużyna Pierścienia',
            'Władca Pierścieni: Dwie wieże',
        ]);
    }

    public function test_not_contains(): void
    {
        $service = app(MovieService::class);
        $results = $service->allWithEvenTitleAndStartingWithLetter(letter: 'W');

        $this->assertNotContains($results, [
            'Django',
            'American Beauty',
            'Szósty zmysł',
            'Gwiezdne wojny: Nowa nadzieja',
        ]);
    }
}
