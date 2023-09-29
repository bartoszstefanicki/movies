<?php

namespace App\Http\Controllers;

use Domain\Movies\Services\MovieService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class MovieController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private MovieService $movieService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => [
                'random_order' => $this->movieService->allWithRandomOrder(limit: 3),
                'even_title_starting_with_w' => $this->movieService->allWithEvenTitleAndStartingWithLetter(letter: 'W'),
                'title_with_words' => $this->movieService->allWithWordsInTitle(),
            ],
        ]);
    }
}
