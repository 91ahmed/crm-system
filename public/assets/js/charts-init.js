$(document).ready(function(){
    // Lead-By-Status Chart
    var statusLables = $('.leads-by-status').attr('data-labels');
    var statusResult = $('.leads-by-status').attr('data-result');
    var statusContent = document.getElementById('leads-by-status');
    var statusChart = new Chart(statusContent, {
        type: 'line',
        data: {
            labels: JSON.parse(statusLables),
            datasets: [{
                label: 'Leads',
                data: JSON.parse(statusResult),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Lead-By-Source Chart
    var sourceLables = $('.leads-by-source').attr('data-labels');
    var sourceResult = $('.leads-by-source').attr('data-result');
    var sourceContent = document.getElementById('leads-by-source');
    var sourceChart = new Chart(sourceContent, {
        type: 'doughnut',
        data: {
            labels: JSON.parse(sourceLables),
            datasets: [{
                label: 'leads count',
                data: JSON.parse(sourceResult),
                backgroundColor: [
                    'rgba(240, 100, 59, 1)',
                    'rgba(248, 204, 107, 1)',
                    'rgba(86, 194, 214, 1)',
                    'rgba(103, 93, 183, 1)'
                ]
            }]
        }
    });

    // Tasks Chart
    var taskLables = $('.activities_tasks').attr('data-labels');
    var taskResult = $('.activities_tasks').attr('data-result');
    var taskContent = document.getElementById('activities_tasks');
    var taskChart = new Chart(taskContent, {
        type: 'doughnut',
        data: {
            labels: JSON.parse(taskLables),
            datasets: [{
                label: 'Tasks',
                data: JSON.parse(taskResult),
                backgroundColor: [
                    'rgba(240, 100, 59, 1)',
                    'rgba(248, 204, 107, 1)',
                    'rgba(86, 194, 214, 1)',
                    'rgba(103, 93, 183, 1)'
                ]
            }]
        }
    });
});