<x-app-layout>
<div class="container mx-auto p-6">
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            📊 {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-4 md:grid-cols-3 gap-6">
        <!-- Cards de resumo -->
        <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mb-6 col-span-4">
            <!-- Total de Tarefas -->
            <div class="bg-gradient-to-r from-purple-700 to-purple-500 p-6 rounded-2xl shadow-lg flex items-center justify-between transform transition hover:scale-105 hover:shadow-xl max-sm:col-span-2">
                <div>
                    <h2 class="text-purple-200 text-sm font-medium uppercase">Total de Tarefas</h2>
                    <p class="text-4xl font-extrabold text-white mt-2">{{ $tasks->count() }}</p>
                </div>
                <div class="text-white text-5xl">📝</div>
            </div>

            <!-- Total de Categorias -->
            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 rounded-2xl shadow-lg flex items-center justify-between transform transition hover:scale-105 hover:shadow-xl max-sm:col-span-2">
                <div>
                    <h2 class="text-green-100 text-sm font-medium uppercase">Total de Categorias</h2>
                    <p class="text-4xl font-extrabold text-white mt-2">{{ $categories->count() }}</p>
                </div>
                <div class="text-white text-5xl">📂</div>
            </div>

        </div>


        <!-- Gráfico Pizza -->
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 p-6 rounded-2xl shadow-lg transform transition hover:scale-105 hover:shadow-xl col-span-2 max-sm:col-span-4">
            <h2 class="text-purple-200 text-lx font-medium uppercase mb-3">📌 Tarefas por Categoria</h2>
            <div id="tasksByCategory" style="height: 300px; width: 100%;"></div>
        </div>

        <!-- Gráfico Colunas -->
        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 p-6 rounded-2xl shadow-lg transform transition hover:scale-105 hover:shadow-xl col-span-1 max-sm:col-span-4">
            <h2 class="text-purple-200 text-lx font-medium uppercase mb-3">✅ Concluídas vs Pendentes</h2>
            <div id="tasksStatus" style="height: 300px;"></div>
        </div>
    </div>
</div>

<!-- Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // Gráfico Pizza
        var dataCategory = google.visualization.arrayToDataTable([
            ['Categoria', 'Tarefas'],
            @foreach ($categories as $category)
                ['{{ $category->name }}', {{ $category->tasks->count() }}],
            @endforeach
        ]);

        var optionsCategory = { pieHole: 0.4, backgroundColor: 'transparent', legendTextStyle: { color: '#fff' } };
        new google.visualization.PieChart(document.getElementById('tasksByCategory'))
            .draw(dataCategory, optionsCategory);

        // Gráfico Colunas
        var dataStatus = google.visualization.arrayToDataTable([
            ['Status', 'Tarefas'],
            ['Concluídas', {{ $tasks->where('status', 'concluida')->count() }}],
            ['Pendentes', {{ $tasks->where('status', 'pendente')->count() }}],
        ]);

        var optionsStatus = { backgroundColor: 'transparent', legend: { position: 'none' }, colors: ['#4F46E5', '#EF4444'] };
        new google.visualization.ColumnChart(document.getElementById('tasksStatus'))
            .draw(dataStatus, optionsStatus);
    }
</script>
</x-app-layout>
