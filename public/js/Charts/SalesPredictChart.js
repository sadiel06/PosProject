
const ctx3 = document.getElementById('predictChart').getContext('2d');
const theirChart1 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Nobiembre', 'Diciembre'],
        datasets: [{
            label: '# Prediccion',
            data: [1200, 1900, 300, 500, 700, 300],
            backgroundColor:'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
        },{
            label: '# Ventas por mes',
            data: [1500, 1300, 200, 600, 900],
            backgroundColor:'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
        }]
    },
});
theirChart1.canvas.parentNode.style.height = 'auto';
theirChart1.canvas.parentNode.style.width = 'auto';
