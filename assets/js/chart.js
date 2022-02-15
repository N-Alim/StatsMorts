function changeYear()
{
    const year = parseInt(document.querySelector('select#years').value);
    
    myChart.data.datasets[0].label = 'Number of deaths in ' + year;
    myChart.data.datasets[0].data = values[year];
    myChart.update();

}

const ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Number of deaths in 2010',
            data:values[2010],
            backgroundColor: ['rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(255, 99, 132, 1)'],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
