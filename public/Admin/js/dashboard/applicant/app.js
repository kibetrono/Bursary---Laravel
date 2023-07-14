var ctx = document.getElementById('applicationStatusDonutChart').getContext('2d');

var backgroundColors = applicationStatuses.map(status => {
    if (status.status === 'Rejected') {
        return 'rgba(255, 99, 132, 0.8)'; // Red (Rejected)
    } else if (status.status === 'Approved') {
        return 'rgba(40, 167, 69, 0.6)'; // Green (Approved)
    } else if (status.status === 'Pending') {
        return 'rgba(255, 206, 86, 0.8)'; // Yellow (Pending)
    } else {
        return 'rgba(0, 0, 0, 0.8)'; // Default color for unknown status
    }
});
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: applicationStatuses.map(status => status.status),
        datasets: [{
            data: applicationStatuses.map(status => status.total),
            backgroundColor: backgroundColors,
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
            },
            tooltip: {
                enabled: false,
            },
            datalabels: {
                anchor: 'center',
                align: 'center',
                color: '#000000',
                font: {
                    weight: 'bold',
                    size: 14,
                },
                formatter: function (value, context) {
                    return value;
                },
            },
        },
    },
});

