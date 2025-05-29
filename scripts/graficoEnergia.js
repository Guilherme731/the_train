google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawStuff);

function drawStuff() {
  var data = new google.visualization.arrayToDataTable([
    ['Move', 'Percentage'],
    ["1° Tri", 10],
    ["2° Tri", 20],
    ["3° Tri", 5],
    ["4° Tri", 25]
  ]);

  var options = {
    width: 300,
    height: 200,
    legend: { position: 'none' },
    axes: {
      x: {
        0: { side: 'top', label: 'Em KWh'} // Top x-axis.
      }
    },
    bar: { groupWidth: "90%" },
    series: {
        0: {color:'mediumseagreen'},
        1: {color:'cyan'},
        2: {color:'#fdbe4d'},
        3: {color:'#fdbe4d'}
    },
    backgroundColor: 'transparent',
    chartArea: {
        backgroundColor: 'transparent'
    }
  };

  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
  // Convert the Classic options to Material options.
  chart.draw(data, google.charts.Bar.convertOptions(options));
};