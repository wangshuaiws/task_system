var Barctx = $('#BarChart');
var dataBar = {
    labels: $('#bar-data').data('names'),
datasets: [
    {
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1,
        data: $('#bar-data').data('count')
}
]
};
var myBarChart = new Chart(Barctx, {
    type: 'bar',
    data: dataBar,
    options: {
        responsive: true,
        title: {
            display: true,
            text: '项目之间的任务总数对比'
        },
        legend: {
            display: false
        }
    }
});