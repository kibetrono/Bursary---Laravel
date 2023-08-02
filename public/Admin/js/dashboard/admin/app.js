

var ctx_approved = document.getElementById('approved_chart').getContext('2d');
var ctx_rejected = document.getElementById('rejected_chart').getContext('2d');
var ctx_pending = document.getElementById('pending_chart').getContext('2d');

// chart for approved
var chart = new Chart(ctx_approved, {
    type: 'bar',
    data: {
        labels: Object.keys(totalApplications),
        datasets: [{
            label: 'Percentage of Approved Applications',
            data: Object.values(approvalPercentages),
            backgroundColor: 'rgba(40, 167, 69, 0.6)', // Success color
            borderColor: 'rgba(40, 167, 69, 1)', // Success color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                stepSize: 10,
                ticks: {
                    callback: function (value) {
                        return value + '%';
                    }
                },
                title: {
                    display: true,
                    text: 'Percentage of Approved Applications'
                }
            }
        }
    },
});

// chart for rejected
var chart = new Chart(ctx_rejected, {

    type: 'bar',
    data: {
        labels: Object.keys(totalApplications),
        datasets: [{
            label: 'Percentage of Rejected Applications',
            data: Object.values(rejectralPercentages),
            backgroundColor: 'rgba(220, 53, 69, 0.6)', // Danger color
            borderColor: 'rgba(220, 53, 69, 1)', // Danger color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    stepSize: 10,
                    callback: function (value) {
                        return value + '%';
                    }
                },
                title: {
                    display: true,
                    text: 'Percentage of Rejected Applications'
                }
            }
        }
    }
});

// chart for pending
var chart = new Chart(ctx_pending, {
    type: 'bar',
    data: {
        labels: Object.keys(totalApplications),
        datasets: [{
            label: 'Percentage of Pending Applications',
            data: Object.values(pendralPercentages),
            backgroundColor: 'rgba(255, 193, 7, 0.6)', // Warning color
            borderColor: 'rgba(255, 193, 7, 1)', // Warning color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                stepSize: 10,
                ticks: {
                    callback: function (value) {
                        return value + '%';
                    }
                },
                title: {
                    display: true,
                    text: 'Percentage of Pending Applications'
                }
            }
        }
    }
});

// top ten constituencies

// Sort the chartData based on the number of applicants in descending order
chartData.sort((a, b) => b.percentage - a.percentage);

// If the number of constituencies is greater than 10, limit to 10, otherwise use all
var limitedChartData = chartData.slice(0, Math.min(chartData.length, 10));

var ctx = document.getElementById('top_ten_constituencies').getContext('2d');
var bursaryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: limitedChartData.map(item => item.constituency), // Constituencies based on priority
        datasets: [{
            label: 'Percentage',
            data: limitedChartData.map(item => item.percentage), // Corresponding percentages
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y', // To display labels on the y-axis
        scales: {
            x: {
                ticks: {
                    callback: function (value) {
                        return value + '%';
                    }
                }
            },
            y: {
                ticks: {
                    callback: function (value) {
                        return value + '%';
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'right',
            }
        },
        maxBarThickness: 50 // Adjust this value to control the width of the bars
    }
});

