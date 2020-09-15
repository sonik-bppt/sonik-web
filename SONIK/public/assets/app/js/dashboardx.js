//== Class definition
var Dashboard = function() {

    //== Sparkline Chart helper function
    var _initSparklineChart = function(src, data, color, border) {
        if (src.length == 0) {
            return;
        }

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "",
                    borderColor: color,
                    borderWidth: border,

                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 12,
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mApp.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    fill: false,
                    data: data,
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false
                    }
                },
                responsive: true,
                maintainAspectRatio: true,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

                elements: {
                    point: {
                        radius: 4,
                        borderWidth: 12
                    },
                },

                layout: {
                    padding: {
                        left: 0,
                        right: 10,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        return new Chart(src, config);
    }

    //== Daily Sales chart.
    //** Based on Chartjs plugin - http://www.chartjs.org/
    var dailySales = function() {
        var chartContainer = $('#id_chart');

        if (chartContainer.length == 0) {
            return;
        }

        var chartData = {
            labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7", "Label 8", "Label 9", "Label 10", "Label 11", "Label 12", "Label 13", "Label 14", "Label 15", "Label 16"],
            datasets: [
            {
	            label: "KPI Total",
	            backgroundColor: "rgb(0,0,255)",
	            borderColor: "rgb(0,0,255)",
	            data: [10, 20, 30, 40],
	
	            // Changes this dataset to become a line
	            type: "line",
	            fill: false,
				pointStyle: 'rect',
				borderDash: [5, 5],
				borderWidth: 3,
	        },
            {
	            label: "KPI Production",
	            backgroundColor: "rgb(255,0,0)",
	            borderColor: "rgb(255,0,0)",
	            data: [10, 20, 30, 40],
	
	            // Changes this dataset to become a line
	            type: "line",
	            fill: false,
				pointStyle: 'rect',
				borderDash: [5, 5],
				borderWidth: 3,
	        },
	        {
	            label: "KPI Non Production",
	            backgroundColor: "rgb(0,255,0)",
	            borderColor: "rgb(0,255,0)",
	            data: [10,20,30,40],
	
	            // Changes this dataset to become a line
	            type: "line",
	            fill: false,
				pointStyle: 'rect',
				borderDash: [5, 5],
				borderWidth: 3,
	        },
	        {
                label: 'Total kWh',
                backgroundColor: mApp.getColor('danger'),
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            },
	        {
                label: 'Production kWh',
                backgroundColor: mApp.getColor('success'),
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }, {
                label: 'Non Production kWh',
                backgroundColor: mApp.getColor('primary'),
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }, 
            ]
        };

        var chart = new Chart(chartContainer, {
            type: 'bar',
            data: chartData,
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'index',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: true
                },
                responsive: true,
                maintainAspectRatio: false,
                barRadius: 4,
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                        	color: "rgba(240,240,240,1)",
                        },
                        stacked: true
                    }],
                    yAxes: [{
                        display: true,
                        stacked: true,
                        gridLines: {
                        	color: "rgba(240,240,240,1)",
                        },
                    }]
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });
    }

    return {
        //== Init demos
        init: function() {
            // init charts
            dailySales();
        }
    };
}();

//== Class initialization on page load
jQuery(document).ready(function() {
    Dashboard.init();
});