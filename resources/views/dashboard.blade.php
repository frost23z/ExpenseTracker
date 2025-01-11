<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-6 flex">
                        <div class="flex flex-col space-y-4">
                            <button onclick="setDateRange('today')" class="px-4 py-2 bg-blue-500 text-white rounded">Today</button>
                            <button onclick="setDateRange('this_month')" class="px-4 py-2 bg-blue-500 text-white rounded">This Month</button>
                            <button onclick="setDateRange('this_year')" class="px-4 py-2 bg-blue-500 text-white rounded">This Year</button>
                            <button onclick="setDateRange('all_time')" class="px-4 py-2 bg-blue-500 text-white rounded">All Time</button>
                            <input type="date" id="start-date" class="px-4 py-2 border rounded" />
                            <input type="date" id="end-date" class="px-4 py-2 border rounded" />
                            <button onclick="loadSummary()" class="px-4 py-2 bg-blue-500 text-white rounded">Show</button>
                        </div>
                        <div id="summary-chart" class="max-w-xl mx-auto">
                            <!-- Summary chart will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadSummary();
        });

        function setDateRange(range) {
            const today = new Date();
            let startDate, endDate;

            switch (range) {
                case 'today':
                    startDate = endDate = today.toISOString().split('T')[0];
                    break;
                case 'this_month':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
                    endDate = today.toISOString().split('T')[0];
                    break;
                case 'this_year':
                    startDate = new Date(today.getFullYear(), 0, 1).toISOString().split('T')[0];
                    endDate = today.toISOString().split('T')[0];
                    break;
                case 'all_time':
                    startDate = '';
                    endDate = '';
                    break;
            }

            document.getElementById('start-date').value = startDate;
            document.getElementById('end-date').value = endDate;
            loadSummary();
        }

        function loadSummary() {
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const query = new URLSearchParams({ start_date: startDate, end_date: endDate, type: 'expense' }).toString();

            fetch(`/summary?${query}`)
                .then(response => response.json())
                .then(data => {
                    const summaryChartDiv = document.getElementById('summary-chart');
                    if (data.length === 0) {
                        summaryChartDiv.innerHTML = '<p class="text-center text-gray-500">No data available.</p>';
                    } else {
                        renderChart(data);
                    }
                });
        }

        function renderChart(data) {
            const ctx = document.createElement('canvas');
            document.getElementById('summary-chart').innerHTML = '';
            document.getElementById('summary-chart').appendChild(ctx);

            const topCategories = data.slice(0, 10);
            const otherCategories = data.slice(10);
            const otherTotal = otherCategories.reduce((sum, item) => sum + item.total, 0);

            const labels = topCategories.map(item => item.category).concat('Others');
            const percentages = topCategories.map(item => item.percentage.toFixed(2)).concat((otherTotal / data.reduce((sum, item) => sum + item.total, 0) * 100).toFixed(2));

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: percentages,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#CCCCCC'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</x-app-layout>
