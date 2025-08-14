<div>
    <div class="bg-bg p-5 rounded-2xl border border-border">
        <h3 class="font-bold mb-4">{{ __('dashboard.monthly_revenue') }}</h3>
        <canvas id="revenueChart" height="200"></canvas>
    </div>


    <script>
        document.addEventListener('livewire:navigated', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            const revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($monthLabels),
                    datasets: [{
                        label: "{{ __('dashboard.revenue') }}",
                        data: @json($monthlyRevenue),
                        backgroundColor: 'rgba(79, 70, 229, 0.7)',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: (ctx) => `${ctx.formattedValue} ₪`
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' ₪';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>


</div>
