<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hello World Mobile</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center p-8 bg-white shadow-lg rounded-xl">
        <h1 class="text-4xl font-bold text-blue-600 mb-2">Hello World !</h1>
        <p class="text-gray-600">Application mobile avec NativePHP</p>
        
        <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="text-sm font-medium text-gray-500 mb-4">Fonctionnalités avancées API</p>
            <a href="{{ route('recipes') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-sm hover:shadow transition-all group w-full sm:w-auto">
                Consommer l'API Recettes
                <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </div>
</body>
</html>