google.charts.load("current", { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    // Usa os dados enviados pelo PHP
    var data = google.visualization.arrayToDataTable(dadosenergiaPHP);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1, {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
    }, 2]);

    var options = {
        title: "En KHh",
        titleTextStyle: { color: '#86bbd8' },
        width: 355,
        height: 130,
        bar: { groupWidth: "95%" },
        legend: { position: "none" },
        backgroundColor: 'transparent',
    chartArea: {
        backgroundColor: 'transparent',
        left: 30
    }
    };

    var chart = new google.visualization.ColumnChart(
        document.getElementById("columnchart_values2")
    );
    chart.draw(view, options);
}