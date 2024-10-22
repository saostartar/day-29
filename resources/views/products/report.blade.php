<canvas id="productChart" width="400" height="200"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('productChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Products', 'Average Price', 'Total Stock'],
        datasets: [{
            label: 'Statistics',
            data: [{{ $totalProducts }}, {{ $averagePrice }}, {{ $totalStock }}],
            backgroundColor: ['rgba(75, 192, 192, 0.2)'],
            borderColor: ['rgba(75, 192, 192, 1)'],
            borderWidth: 1
        }]
    }
});
</script>
