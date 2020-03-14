var labels = [];
var result = [];
let backgroundColor = [];
let borderColor = [];

(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {
      $('#myChart', context).once('chartBehavior').each(function () {

        var data = drupalSettings.statistic;
        for (var i = 0; i < data.length; i++) {
          if (data[i][0] != null && data[i][1] != null) {
            result.push(data[i][1]);
            result.push(data[i][2]);
            labels.push(data[i][0] + ' To do');
            labels.push(data[i][0] + ' Spent');
            backgroundColor.push('blue');
            backgroundColor.push('red');
            borderColor.push('black');
          }
        }
        chart();
      });
    }
  };

  function chart() {
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: backgroundColor,
          borderColor: borderColor,
          borderWidth: 1
        }]
      },
      options: {
        title: {
          display: true,
          text: "Chart"
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false,
        }
      }
    });
  }

})(jQuery, Drupal, drupalSettings);
