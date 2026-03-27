<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class RecipeService
{
    public function getRecipes(): Collection
    {
        $url = 'https://www.themealdb.com/api/json/v1/1/search.php?s=';

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->get($url);

        if ($response->successful()) {
            return collect($response->json('meals') ?? []);
        }

        return collect([]);
    }
}
