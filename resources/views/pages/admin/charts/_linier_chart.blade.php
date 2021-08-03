<div class="chart-container mt-3"
     style="position: relative; height:400px; width:100%; margin-bottom: 100px;">
    <canvas id="chart"></canvas>
</div>

<script src="{{ asset('vendor/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script defer>
    $(document).ready(function () {
        let from, to;
        to = $("#to").persianDatepicker({
            altField: '[name=to]',
            initialValue: false,
            observer: true,
            autoClose: true,
            format: 'YYYY/MM/DD',
            onSelect: function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate !== unix) {
                    let cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            }
        });

        from = $("#from").persianDatepicker({
            altField: '[name=from]',
            initialValue: false,
            observer: true,
            autoClose: true,
            format: 'YYYY/MM/DD',
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate !== unix) {
                    let cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });

        Chart.defaults.global.defaultFontFamily = 'IRANSans, Tahoma, serif;';

        new Chart(document.getElementById('chart').getContext('2d'), {
            type: 'line',
            data: {
                labels: JSON.parse('{!! json_encode($labels) !!}'),
                datasets: [{
                    label: {!! json_encode($title) !!},
                    backgroundColor: 'rgb(0, 108, 132)',
                    borderColor: 'rgb(135, 47, 132)',
                    data: JSON.parse('{!! json_encode($data) !!}'),
                    fill: false,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            stepSize: 1,
                            beginAtZero: true,
                        },
                    }],
                },
            }
        });
    });
</script>
