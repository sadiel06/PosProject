const ctx1 = document.getElementById('productChart').getContext('2d');
const yourChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Pantalon clx', 'Poloshirt fox', 'reloj stole', 'interior', 'manga larga polo', 'bufanda'],
        datasets: [{
            label: '# total de ventas',
            data: [12000, 8000, 3000, 4000, 7000, 3000],
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
yourChart.canvas.parentNode.style.height = 'auto';
yourChart.canvas.parentNode.style.width = 'auto';
