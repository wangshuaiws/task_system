var ctxPie = $('#pieChart');
var data = {
    labels: [
        "未完成",
        "已完成"
    ],
    datasets: [
        {
            data: [$('#pie-data').data('todo'),$('#pie-data').data('done')],
backgroundColor: [
    "#FF6384",
    "#36A2EB"
],
    hoverBackgroundColor: [
    "#FF6384",
    "#36A2EB"
]
}]
};

var myPieChart = new Chart(ctxPie,{
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        title: {
            display: true,
            text: '所有任务完成比例(总数:' + $('#pie-data').data('total') + ')'
        }
    }
});