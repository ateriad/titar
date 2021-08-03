<div class="chart-container">
    <div class="pie-chart-container">
        <canvas id="chart"></canvas>
    </div>
</div>

<!-- javascript -->
<script src="{{ asset('vendor/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(function(){
        var data = {
            labels: {!! json_encode($data['labels']) !!},
            datasets: [
                {
                    label: "Users Count",
                    data: {!! json_encode($data['data']) !!},
                    backgroundColor: [
                        "#DEB887",
                        "#A9A9A9",
                        "#DC143C",
                        "#F4A460",
                        "#2E8B57",
                        "#1D7A46",
                        "#CDA776",
                    ],
                    borderColor: [
                        "#CDA776",
                        "#989898",
                        "#CB252B",
                        "#E39371",
                        "#1D7A46",
                        "#F4A460",
                        "#CDA776",
                    ],
                    borderWidth: [1, 1, 1, 1, 1,1,1]
                }
            ]
        };

        var options = {
            responsive: true,
            title: {
                display: true,
                position: "top",
                text: {!! json_encode($title) !!},
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            }
        };

        new Chart(document.getElementById('chart').getContext('2d'), {
            type: "pie",
            data: data,
            options: options
        });
    });
</script>
