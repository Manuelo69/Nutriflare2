<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas de Seguimiento') }}
        </h2>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>

    <body class="bg-gray-100">

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4 text-center">Peso</h2>
                    <div class="h-64">
                        <canvas id="pesoChart"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4 text-center">Minutos cardio</h2>
                    <div class="h-64">
                        <canvas id="cardioChart"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4 text-center">Grasa Corporal</h2>
                    <div class="h-64">
                        <canvas id="grasaCorporalChart"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4 text-center">Progreso</h2>
                    <div class="h-64">
                        <canvas id="progresoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const seguimientos = @json($seguimientos);

            const labels = seguimientos.map(s => new Date(s.created_at).toLocaleDateString());

            const pesoData = seguimientos.map(s => s.peso);
            const cardioData = seguimientos.map(s => s.minutos_cardio);
            const grasaCorporalData = seguimientos.map(s => s.grasa_corporal);
            const progresoData = seguimientos.map(s => s.porcentaje_progreso);

            const config = (label, data, backgroundColor, borderColor) => ({
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(document.getElementById('pesoChart').getContext('2d'), config('Peso', pesoData, 'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 1)'));
            new Chart(document.getElementById('cardioChart').getContext('2d'), config('Minutos cardio', cardioData,
                'rgba(75, 192, 192, 0.2)', 'rgba(75, 192, 192, 1)'));
            new Chart(document.getElementById('grasaCorporalChart').getContext('2d'), config('Grasa Corporal',
                grasaCorporalData, 'rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)'));
            new Chart(document.getElementById('progresoChart').getContext('2d'), config('Progreso', progresoData,
                'rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)'));
        </script>
    </body>

</x-app-layout>
