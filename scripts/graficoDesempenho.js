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

google.charts.load('current', { 'packages': ['bar'] });
google.charts.setOnLoadCallback(drawStuff);

function drawStuff() {
  var data = new google.visualization.arrayToDataTable([
    ['Move', 'Percentage'],
    ["King's pawn (e4)", 25],
    ["Queen's pawn (d4)", 20],
    ["Knight to King 3 (Nf3)", 15],
    ["Queen's bishop pawn (c4)", 10],
    ['Other', 3]
  ]);

  var options = {
    backgroundColor: 'transparent',
    width: 800,
    legend: { position: 'none' },
    chart: {
      title: 'Chess opening moves',
      subtitle: 'popularity by percentage'
    },
    axes: {
      x: {
        0: { side: 'top', label: 'White to move' } // Top x-axis.
      }
    },
    bar: { groupWidth: "90%" }
  };

  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
  // Convert the Classic options to Material options.
  chart.draw(data, google.charts.Bar.convertOptions(options));
};

