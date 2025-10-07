google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
   var data = google.visualization.arrayToDataTable(dadosdesempenhoPHP);

   var view = new google.visualization.DataView(data);
    view.setColumns([0, 1, {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
    }, 2]);

  var options = {
    width: 205,
    title: '% de viagens sem atraso',
    titleTextStyle: { color: '#86bbd8' },
    legend: 'none',
    series: {
      0: { color: '#a07932' },
      1: { color: '#ffdd9f' },
      2: { color: '#fdbe4d' }
    },
    backgroundColor: 'transparent',
  };
  var chart = new google.visualization.LineChart(document.getElementById('graficoDesempenho'));

  chart.draw(data, options);
}


