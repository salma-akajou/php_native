<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Recettes Gourmet</title>
</head>
<body class="bg-orange-50 min-h-screen font-sans">
    
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold text-orange-600 flex items-center gap-2">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                Gourmet API
            </h1>
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-orange-600 font-medium transition flex items-center gap-1 text-sm bg-gray-50 px-3 py-2 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour Hello World
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8" 
          x-data="{ 
              recipes: {{ json_encode($recipes) }}, 
              searchQuery: '',
              
              get filteredRecipes() {
                  return this.recipes.filter(recipe => {
                      return recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                  });
              }
          }">
        
        <div class="bg-white p-5 rounded-2xl shadow-md mb-8 ring-1 ring-gray-100">
            <div class="flex flex-col md:flex-row gap-4">
                
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-all" 
                           placeholder="Chercher une recette (ex: Soup, Beef)...">
                </div>

            </div>
            
            <div class="mt-4 text-sm text-gray-500 flex justify-between items-center">
                <div>
                    <span class="font-bold text-gray-800" x-text="filteredRecipes.length"></span> recettes affichées 
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            <template x-for="recipe in filteredRecipes" :key="recipe.id">
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group flex flex-col h-full transform hover:-translate-y-1 cursor-pointer">
                    
                    <div class="relative h-48 sm:h-56 bg-gray-100">
                        <img :src="recipe.thumb" :alt="recipe.name" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-lg text-xs font-bold text-orange-600 shadow-sm" x-text="recipe.category"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <h3 class="text-lg font-bold leading-tight drop-shadow-md" x-text="recipe.name"></h3>
                            <p class="text-xs text-gray-300 mt-1 flex items-center gap-1 font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span x-text="recipe.area"></span>
                            </p>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow bg-white">
                        
                        <div class="flex flex-wrap gap-2 mb-4" x-show="recipe.tags && recipe.tags.length > 0">
                            <template x-for="tag in recipe.tags.slice(0, 3)" :key="tag">
                                <span class="px-2 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-[10px] uppercase font-bold rounded-lg tracking-wider" x-text="tag"></span>
                            </template>
                        </div>

                        <div class="flex-grow"></div>

                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                            <a :href="recipe.youtube || '#'" target="_blank" 
                               class="text-sm font-semibold transition-colors flex items-center gap-1.5"
                               :class="recipe.youtube ? 'text-orange-500 hover:text-red-500' : 'text-gray-300 cursor-not-allowed pointer-events-none'">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span x-text="recipe.youtube ? 'Voir la vidéo' : 'Pas de vidéo'"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="filteredRecipes.length === 0" class="col-span-full py-16 px-4 text-center bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                <div class="bg-gray-50 p-4 rounded-full mb-4">
                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Aucun plat trouvé</h3>
                <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">Nous n'avons trouvé aucune recette correspondant à votre recherche.</p>
                <button @click="searchQuery = ''" class="mt-6 px-5 py-2.5 text-sm text-orange-600 font-bold bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors">Effacer la recherche</button>
            </div>

        </div>
    </main>

</body>
</html>
