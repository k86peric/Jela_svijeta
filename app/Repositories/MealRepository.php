<?php

namespace App\Repositories;

use App\Models\Meal;
use Carbon\Carbon;

class MealRepository
{

    public function getAllMeals()
    {
        return Meal::paginate(5);
    }

    public function getFilteredMeals($perPage, $category, $tags, $tagIds, $lang, $diffTime, $with)
    {
        $query = Meal::query();

        if ($category !== null) {
            $query->where('category_id', $category);
        }

        if ($tagIds !== null) {
            $tagIdsArray = explode(',', $tagIds);
            $query->whereHas('tags', function ($q) use ($tagIdsArray) {
                $q->whereIn('id', $tagIdsArray);
            });
        }

        if ($lang !== null) {
            $query->with(['translations' => function ($q) use ($lang) {
                $q->where('locale', $lang);
            }]);
        }

        if ($diffTime !== null) {
            $query->where('updated_at', '>=', Carbon::createFromTimestamp($diffTime));
        }

        if ($with !== null) {
            $eagerLoad = explode(',', $with);
            $query->with($eagerLoad);
        }


        $query = Meal::select('meals.id', 'meal_translations.title', 'meal_translations.description', 'meals.status')
            ->addSelect('category_translations.title as category_title', 'categories.slug as category_slug', 'categories.id as category_id')
            ->with(['category', 'ingredients', 'tags'])
            ->with(['tags' => function ($query) use ($lang) {
                $query->join('tag_translations', 'tags.id', '=', 'tag_translations.tag_id')
                    ->where('tag_translations.locale', $lang)
                    ->select('tags.id', 'tag_translations.title as tag_title', 'tags.slug as tag_slug');
            }])
            ->with(['ingredients' => function ($query) use ($lang) {
                $query->join('ingredient_translations', 'ingredients.id', '=', 'ingredient_translations.ingredient_id')
                    ->where('ingredient_translations.locale', $lang)
                    ->select('ingredients.id', 'ingredient_translations.title as ingredient_title', 'ingredients.slug as ingredient_slug');
            }])
            ->join('meal_translations', 'meals.id', '=', 'meal_translations.meal_id')
            ->leftJoin('categories', 'meals.category_id', '=', 'categories.id')
            ->leftJoin('category_translations', function ($join) use ($lang) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.locale', $lang);
            })
            ->where('meal_translations.locale', $lang)
            ->when($category, function ($query, $category) {
                return $query->where('meals.category_id', $category);
            })
            ->when($tags, function ($query, $tags) {
                return $query->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('tags.id', explode(',', $tags));
                });
            })
            ->when($diffTime, function ($query, $diffTime) {
                return $query->where('meals.updated_at', '>=', Carbon::createFromTimestamp($diffTime));
            });

            return $query->paginate($perPage);

    }
}