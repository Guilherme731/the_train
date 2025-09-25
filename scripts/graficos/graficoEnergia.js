google.charts.load("current", { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Série", { role: "style" }],
    ["Trem 1", 10, "#5cc0cd"],
    ["Trem 2", 20, "#5fc3f4"],
    ["Trem 3", 5, "#5cc0cd"],
    ["Trem 4", 25, "#5fc3f4"],

  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
    {
      calc: "stringify",
      sourceColumn: 1,
      type: "string",
      role: "annotation"
    },
    2]);

  var options = {
    title: "Em KWh",
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
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
  chart.draw(view, options);
}