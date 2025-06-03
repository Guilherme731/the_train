google.charts.load("current", { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Série", { role: "style" }],
    ["1°Tri", 10, "#5cc0cd"],
    ["2°Tri", 20, "#5fc3f4"],
    ["3°Tri", 5, "#5cc0cd"],
    ["4°Tri", 25, "#5fc3f4"],

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
    width: 420,
    height: 130,
    bar: { groupWidth: "95%" },
    legend: { position: "none" },
    backgroundColor: 'transparent',
    chartArea: {
      backgroundColor: 'transparent'
    }
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
  chart.draw(view, options);
}