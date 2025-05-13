google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Mes', 'Trem 1', 'Trem 2', 'Trem 3'],
    ['2004',  90,       40,        30],
    ['2005',  95,       70,        80],
    ['2006',  87,       89,        70]
  ]);

  var options = {
  };

  var chart = new google.visualization.LineChart(document.getElementById('graficoDesempenho'));

  chart.draw(data, options);
}