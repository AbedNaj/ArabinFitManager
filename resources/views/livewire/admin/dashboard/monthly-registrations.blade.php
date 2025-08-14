<div>
    <div>
        <div class="bg-bg p-5 rounded-2xl border border-border">

            <h3 class="font-bold mb-4">{{ __('dashboard.monthly_members_count') }}</h3>
            <canvas id="registrationsChart" height="200"></canvas>
        </div>


        <script>
            document.addEventListener('livewire:navigated', function() {
                const ctx = document.getElementById('registrationsChart').getContext('2d');

                const registrationsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($monthLabels),
                        datasets: [{
                            label: "{{ __('dashboard.revenue') }}",
                            data: @json($monthlyRegistrations),
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
                                    label: (ctx) => `${ctx.formattedValue} `
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value + ' ';
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>


    </div>

</div>
