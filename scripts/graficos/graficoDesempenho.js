google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
   var data = google.visualization.arrayToDataTable(dadosdesempenhoPHP);

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


