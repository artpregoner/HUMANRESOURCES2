var chart = new Chartist.Pie('.all-employee-list', {
    series: [60, 20, 5],
    labels: ['orange', 'Apples', 'Grapes']
}, {
    donut: true,
    showLabel: false,
    donutWidth: 40
});