google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Mes', 'Trem 1', 'Trem 2', 'Trem 3'],
    ['Abril',  90,       40,        30],
    ['Maio',  95,       70,        80],
    ['Junho',  87,       89,        70]
  ]);

  var options = {
  };

  var chart = new google.visualization.LineChart(document.getElementById('graficoDesempenho'));

  chart.draw(data, options);
}

