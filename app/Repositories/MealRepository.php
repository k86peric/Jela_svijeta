<?php

namespace App\Repositories;

use App\Models\Meal;
use Carbon\Carbon;

class MealRepository
{

    public function getAllMeals(string $lang)
    {
        $query = Meal::select('meals.id', 'meal_translations.title', 'meal_translations.description', 'meals.status');
        $query->join('meal_translations', 'meals.id', '=', 'meal_translations.meal_id');
        $query->where('meal_translations.locale', $lang);

        return $query;
    }

    public function getFilteredMeals($category, $tags, $tagIds, $lang, $diffTime, $with)
    {
        $query = $this->getAllMeals($lang);

        if ($category !== null) {
            $query->where('meals.category_id', $category);
        }

        if ($tagIds !== null) {
            $tagIdsArray = explode(',', $tagIds);
            $query->whereHas('tags', function ($q) use ($tagIdsArray) {
                $q->whereIn('tags.id', $tagIdsArray);
            });
        }

        if ($lang !== null) {
            $query->with(['translations' => function ($q) use ($lang) {
                $q->where('locale', $lang);
            }]);
        }

        if ($diffTime !== null) {
            $query->where('meals.updated_at', '>=', Carbon::createFromTimestamp($diffTime));
        }

        if ($with !== null) {
            $with = explode(',', $with);

                if (in_array('category', $with)) {
                    $query->addSelect('category_translations.title as category_title', 'categories.slug as category_slug', 'categories.id as category_id');
                    $query->leftJoin('categories', 'meals.category_id', '=', 'categories.id');
                    $query->leftJoin('category_translations', function ($join) use ($lang) {
                        $join->on('categories.id', '=', 'category_translations.category_id')
                            ->where('category_translations.locale', $lang);
                    });
                }

                if (in_array('tags', $with)) {
                    $query->with(['tags' => function ($query) use ($lang) {
                        $query->join('tag_translations', 'tags.id', '=', 'tag_translations.tag_id')
                            ->where('tag_translations.locale', $lang)
                            ->select('tags.id', 'tag_translations.title as tag_title', 'tags.slug as tag_slug');
                    }]);
                }

                if (in_array('ingredients', $with)) {
                    $query->with(['ingredients' => function ($query) use ($lang) {
                        $query->join('ingredient_translations', 'ingredients.id', '=', 'ingredient_translations.ingredient_id')
                            ->where('ingredient_translations.locale', $lang)
                            ->select('ingredients.id', 'ingredient_translations.title as ingredient_title', 'ingredients.slug as ingredient_slug');
                    }]);
                }  

        }
            return $query;

    }
}