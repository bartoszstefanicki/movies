<?php

namespace Tests\Unit\Movies;

use Domain\Movies\Services\MovieService;
use Mockery\MockInterface;
use Tests\TestCase;

abstract class MovieTestAbstract extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $mock = $this->partialMock(MovieService::class, function (MockInterface $mock) {
            $mock->shouldReceive('all')->andReturn($this->getTestMovies());
        });

        $this->app->instance(MovieService::class, $mock);
    }

    private function getTestMovies(): array
    {
        return [
            "Whiplash",
            "Wyspa tajemnic",
            "Django",
            "American Beauty",
            "Szósty zmysł",
            "Gwiezdne wojny: Nowa nadzieja",
            "Mroczny Rycerz",
            "Władca Pierścieni: Drużyna Pierścienia",
            "Harry Potter i Kamień Filozoficzny",
            "Green Mile",
            "Iniemamocni",
            "Shrek",
            "Mad Max: Na drodze gniewu",
            "Terminator 2: Dzień sądu",
            "Piraci z Karaibów: Klątwa Czarnej Perły",
            "Truman Show",
            "Skazany na bluesa",
            "Infiltracja",
            "Gran Torino",
            "Spotlight",
            "Mroczna wieża",
            "Rocky",
            "Casino Royale",
            "Drive",
            "Piękny umysł",
            "Władca Pierścieni: Dwie wieże",
        ];
    }
}
