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
            <div class="bg-gradient-to-r from-purple-700 to-purple-500 p-6 rounded-2xl shadow-lg flex items-center justify-between transform transition hover:scale-105 hover:shadow-xl">
                <div>
                    <h2 class="text-purple-200 text-sm font-medium uppercase">Total de Tarefas</h2>
                    <p class="text-4xl font-extrabold text-white mt-2">{{ $tasks->count() }}</p>
                </div>
                <div class="text-white text-5xl">📝</div>
            </div>

            <!-- Total de Categorias -->
            <div class="bg-gradient-to-r from-green-600 to-green-400 p-6 rounded-2xl shadow-lg flex items-center justify-between transform transition hover:scale-105 hover:shadow-xl">
                <div>
                    <h2 class="text-green-100 text-sm font-medium uppercase">Total de Categorias</h2>
                    <p class="text-4xl font-extrabold text-white mt-2">{{ $categories->count() }}</p>
                </div>
                <div class="text-white text-5xl">📂</div>
            </div>

        </div>


        <!-- Gráfico Pizza -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 p-6 rounded-2xl shadow-lg transform transition hover:scale-105 hover:shadow-xl col-span-2">
            <h2 class="text-xl font-semibold text-gray-200 mb-3">📌 Tarefas por Categoria</h2>
            <div id="tasksByCategory" style="height: 300px;"></div>
        </div>

        <!-- Gráfico Colunas -->
        <div class="bg-gradient-to-r from-pink-600 to-pink-400 p-6 rounded-2xl shadow-lg transform transition hover:scale-105 hover:shadow-xl col-span-1">
            <h2 class="text-xl font-semibold text-gray-200 mb-3">✅ Concluídas vs Pendentes</h2>
            <div id="tasksStatus" style="height: 300px;"></div>
        </div>

        <!-- Gráfico Linha -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-400 p-6 rounded-2xl shadow-lg transform transition hover:scale-105 hover:shadow-xl md:col-span-4">
            <h2 class="text-xl font-semibold text-gray-200 mb-3">📈 Tarefas Criadas por Mês</h2>
            <div id="tasksByMonth" style="height: 350px;"></div>
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
            ['Trabalho', 11],
            ['Estudos', 7],
            ['Pessoal', 5],
            ['Saúde', 2],
            ['Outros', 3]
        ]);

        var optionsCategory = { pieHole: 0.4, backgroundColor: 'transparent', legendTextStyle: { color: '#fff' } };
        new google.visualization.PieChart(document.getElementById('tasksByCategory'))
            .draw(dataCategory, optionsCategory);

        // Gráfico Colunas
        var dataStatus = google.visualization.arrayToDataTable([
            ['Status', 'Tarefas'],
            ['Concluídas', 14],
            ['Pendentes', 8],
        ]);

        var optionsStatus = { backgroundColor: 'transparent', legend: { position: 'none' }, colors: ['#4F46E5', '#EF4444'] };
        new google.visualization.ColumnChart(document.getElementById('tasksStatus'))
            .draw(dataStatus, optionsStatus);

        // Gráfico Linha
        var dataMonth = google.visualization.arrayToDataTable([
            ['Mês', 'Tarefas'],
            ['Jan', 5],
            ['Fev', 8],
            ['Mar', 6],
            ['Abr', 12],
            ['Mai', 9],
            ['Jun', 14],
        ]);

        var optionsMonth = { backgroundColor: 'transparent', colors: ['#10B981'], legendTextStyle: { color: '#fff' } };
        new google.visualization.LineChart(document.getElementById('tasksByMonth'))
            .draw(dataMonth, optionsMonth);
    }
</script>
</x-app-layout>
