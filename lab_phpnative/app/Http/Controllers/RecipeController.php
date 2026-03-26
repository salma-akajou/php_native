<?php

namespace App\Http\Controllers;

use App\Services\RecipeService;
use Illuminate\View\View;

class RecipeController extends Controller
{
    protected RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index(): View
    {
        $recipes = $this->recipeService->getRecipes();
        
        $recipesData = $recipes->map(function($meal) {
            return [
                'id' => $meal['idMeal'],
                'name' => $meal['strMeal'],
                'category' => $meal['strCategory'],
                'area' => $meal['strArea'],
                'thumb' => $meal['strMealThumb'],
                'tags' => $meal['strTags'] ? explode(',', $meal['strTags']) : [],
                'youtube' => $meal['strYoutube'],
            ];
        });

        return view('recipes', [
            'recipes' => $recipesData
        ]);
    }
}
