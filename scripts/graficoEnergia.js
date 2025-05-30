google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawStuff);

function drawStuff() {
  var data = new google.visualization.arrayToDataTable([
    ['Move', 'Serie'],
    ["1° Tri", 10],
    ["2° Tri", 20],
    ["3° Tri", 5],
    ["4° Tri", 25]
  ]);

data.setProperty(0, 1, 'style', 'color: #FF0000'); // 1º Tri
data.setProperty(1, 1, 'style', '#00FF00'); // 2º Tri
data.setProperty(2, 1, 'style', '#0000FF'); // 3º Tri
data.setProperty(3, 1, 'style', '#FFA500'); // 4º Tri

  var options = {
    width: 300,
    height: 200,
    legend: { position: 'none' },
    bar: { groupWidth: "90%" },
    backgroundColor: 'transparent',
    chartArea: {
        backgroundColor: 'transparent'
    }
  };

  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
  // Convert the Classic options to Material options.
  chart.draw(data, google.charts.Bar.convertOptions(options));
};