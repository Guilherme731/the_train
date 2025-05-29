google.charts.load('current', { 'packages': ['bar'] });
google.charts.setOnLoadCallback(drawStuff);

function drawStuff() {
  var data = new google.visualization.arrayToDataTable([
    ['Trimestre', 'Série', 'Série'],
    ['1°Tri', 1, 10],
    ['2°Tri', 1, 20],
    ['3°Tri', 1, 5],
    ['4°Tri', 1, 25],
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
