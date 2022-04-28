
const ctx2 = document.getElementById('sizeChart').getContext('2d');
const theirChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['XS','2X','L','2XL','M','S'],
        datasets: [{
            label: '# total de ventas',
            data: [24, 38, 6, 10, 14, 6],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        }]
    },
});
theirChart.canvas.parentNode.style.height = 'auto';
theirChart.canvas.parentNode.style.width = 'auto';
