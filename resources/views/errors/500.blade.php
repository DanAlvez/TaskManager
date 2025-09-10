<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="text-center max-w-lg">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="bg-indigo-600 p-4 rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" viewBox="0 0 64 64" fill="none">
                    <rect width="64" height="64" rx="12" fill="#4F46E5"/>
                    <path d="M20 20H44V24H20V20ZM20 30H44V34H20V30ZM20 40H34V44H20V40Z" fill="white"/>
                    <path d="M40 42L44 46L52 36" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Título -->
        <h1 class="text-4xl font-bold mb-3">ERRO 500</h1>

        <!-- Subtítulo -->
        <p class="text-gray-300 mb-8">
            Erro interno do servidor.
        </p>
    </div>

</body>
</html>
