google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Mes', 'Trem 1', 'Trem 2', 'Trem 3'],
    ['Abril', 95, 90, 83],
    ['Maio', 93, 96, 87],
    ['Junho', 85, 89, 95]
  ]);

  var options = {
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


