<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealListRequest;
use App\Http\Controllers\Controller;
use App\Repositories\MealRepository;

class MealController extends Controller
{

    protected $mealRepository;

    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    public function index(MealListRequest $request)
    {
        $perPage = $request->query('per_page', 10);
        $category = $request->query('category');
        $tagIds = $request->query('tags');
        $with = $request->query('with');
        $lang = $request->query('lang');
        $diffTime = $request->query('diff_time');
        $tags = $request->input('tags');
        

        if (empty($category) && empty($tags) && empty($tagIds) && empty($lang) && empty($diffTime) && empty($with)) {
            
            $meals = $this->mealRepository->getAllMeals();
        } else {
            
            $meals = $this->mealRepository->getFilteredMeals($perPage, $category, $tags, $tagIds, $lang, $diffTime, $with);
        }

        $response = [
            'meta' => [
                'currentPage' => $meals->currentPage(),
                'totalItems' => $meals->total(),
                'itemsPerPage' => $meals->perPage(),
                'totalPages' => $meals->lastPage(),
            ],
            'data' => $meals->items(),
            'links' => [
                'prev' => $meals->previousPageUrl(),
                'next' => $meals->nextPageUrl(),
                'self' => $meals->url($meals->currentPage()),
            ],
        ];

        return response()->json($response);
    }
}