<?php

namespace Tests\Unit\Movies;

use Domain\Movies\Services\MovieService;

class MovieWithWordsInTitleTest extends MovieTestAbstract
{
    public function test_with_one_word(): void
    {
        $service = app(MovieService::class);
        $results = $service->allWithWordsInTitle();

        $this->assertNotContains($results, [
            'Iniemamocni',
            'Shrek',
            'Rocky',
            'Drive',
        ]);
    }

    public function test_with_words(): void
    {
        $service = app(MovieService::class);
        $results = $service->allWithWordsInTitle();

        $this->assertNotContains($results, [
            'Szósty zmysł',
            'Gwiezdne wojny: Nowa nadzieja',
            'Mroczny Rycerz',
            'Władca Pierścieni: Drużyna Pierścienia',
        ]);

        $this->assertCount(18, $results);
    }
}
