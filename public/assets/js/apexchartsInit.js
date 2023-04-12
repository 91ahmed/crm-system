$(document).ready(function(){
  
  // Line Chart
  var statusLables = $('.leads-by-status').attr('data-labels');
  var statusResult = $('.leads-by-status').attr('data-result');
  var lineChart = new ApexCharts(document.getElementById('leads-by-status'), {
    chart: {
      type: 'bar'
    },
    series: [{
      name: 'sales',
      data: JSON.parse(statusResult)//[30,40,35,50,49,60,70,91,125,54,22]
    }],
    xaxis: {
      categories: JSON.parse(statusLables),//[1991,1992,1993,1994,1995,1996,1997, 1998,1999]
      labels: {
        show: true,
        rotate: -45
      }
    }
    //labels: JSON.parse(statusLables)//[1991,1992,1993,1994,1995,1996,1997, 1998,1999]
    //labels: JSON.parse(statusLables)//[1991,1992,1993,1994,1995,1996,1997, 1998,1999]
  });

  lineChart.render();

  // Bar Chart
  var sourceLables = $('.leads-by-source').attr('data-labels');
  var sourceResult = $('.leads-by-source').attr('data-result');
  var barChart = new ApexCharts(document.getElementById('leads-by-source'), {
    chart: {
      type: 'donut'
    },
    stroke:{
      colors:['transparent']
    },
    colors:['#F05050', '#0983E1', '#D5A34C', '#675DB7'],
    series: JSON.parse(sourceResult),
    labels: JSON.parse(sourceLables),
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 100
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    dataLabels: {
      enabled: true,
      textAnchor: 'middle',
      style:{
        fontSize: '12px',
      },
      dropShadow: {
          enabled: false,
          top: 1,
          left: 1,
          blur: 1,
          color: '#000',
          opacity: 0.45
      }
    }
  });

  barChart.render();


  // Bar Chart 2
  var taskLables = $('.activities_tasks').attr('data-labels');
  var taskResult = $('.activities_tasks').attr('data-result');
  var barChart2 = new ApexCharts(document.getElementById('activities_tasks'), {
    chart: {
      type: 'donut'
    },
    stroke:{
      colors:['transparent']
    },
    colors:['#F05050', '#0983E1', '#D5A34C', '#675DB7'],
    series: JSON.parse(taskResult),
    labels: JSON.parse(taskLables),
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 100
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    dataLabels: {
      enabled: true,
      textAnchor: 'middle',
      style:{
        fontSize: '12px',
      },
      dropShadow: {
          enabled: false,
          top: 1,
          left: 1,
          blur: 1,
          color: '#000',
          opacity: 0.45
      }
    }
  });

  barChart2.render();

/*
  // Radialbar Chart
  var radialbar = new ApexCharts(document.querySelector("#radialbar"), {
    chart: {
      height: 180,
      type: "radialBar"
    },
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            show: true,
          },
          value: {
            offsetY: -18, // -8 worked for me
            show: true,
            fontSize: '14px',
            formatter: function (val) {
              return val + '%67'
            }
          }
        }
      }
    },
  });

  radialbar.render();
*/

});