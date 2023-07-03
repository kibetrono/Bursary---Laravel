

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
                    callback: function(value) {
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
                    callback: function(value) {
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
                    callback: function(value) {
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
