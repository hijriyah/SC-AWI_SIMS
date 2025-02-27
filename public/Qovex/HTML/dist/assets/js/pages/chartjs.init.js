!(function (d) {
    "use strict";
    function r() {}
    (r.prototype.respChart = function (r, o, e, a) {
        (Chart.defaults.global.defaultFontColor = "#8791af"),
            (Chart.defaults.scale.gridLines.color = "rgba(166, 176, 207, 0.1)");
        var t = r.get(0).getContext("2d"),
            n = d(r).parent();
        function i() {
            r.attr("width", d(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, { type: "line", data: e, options: a });
                    break;
                case "Doughnut":
                    new Chart(t, { type: "doughnut", data: e, options: a });
                    break;
                case "Pie":
                    new Chart(t, { type: "pie", data: e, options: a });
                    break;
                case "Bar":
                    new Chart(t, { type: "bar", data: e, options: a });
                    break;
                case "Radar":
                    new Chart(t, { type: "radar", data: e, options: a });
                    break;
                case "PolarArea":
                    new Chart(t, { data: e, type: "polarArea", options: a });
            }
        }
        d(window).resize(i), i();
    }),
        (r.prototype.init = function () {
            this.respChart(
                d("#lineChart"),
                "Line",
                {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                    ],
                    datasets: [
                        {
                            label: "Sales Analytics",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(59, 93, 231, 0.2)",
                            borderColor: "#3b5de7",
                            borderCapStyle: "butt",
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: "miter",
                            pointBorderColor: "#3b5de7",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#3b5de7",
                            pointHoverBorderColor: "#fff",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80],
                        },
                        {
                            label: "Monthly Earnings",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(235, 239, 242, 0.2)",
                            borderColor: "#ebeff2",
                            borderCapStyle: "butt",
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: "miter",
                            pointBorderColor: "#ebeff2",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#ebeff2",
                            pointHoverBorderColor: "#eef0f2",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [80, 23, 56, 65, 23, 35, 85, 25, 92, 36],
                        },
                    ],
                },
                {
                    scales: {
                        yAxes: [{ ticks: { max: 100, min: 20, stepSize: 10 } }],
                    },
                }
            ),
                this.respChart(d("#doughnut"), "Doughnut", {
                    labels: ["Desktops", "Tablets"],
                    datasets: [
                        {
                            data: [300, 210],
                            backgroundColor: ["#3b5de7", "#ebeff2"],
                            hoverBackgroundColor: ["#3b5de7", "#ebeff2"],
                            hoverBorderColor: "#fff",
                        },
                    ],
                }),
                this.respChart(d("#pie"), "Pie", {
                    labels: ["Desktops", "Tablets"],
                    datasets: [
                        {
                            data: [300, 180],
                            backgroundColor: ["#45cb85", "#ebeff2"],
                            hoverBackgroundColor: ["#45cb85", "#ebeff2"],
                            hoverBorderColor: "#fff",
                        },
                    ],
                }),
                this.respChart(
                    d("#bar"),
                    "Bar",
                    {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                        ],
                        datasets: [
                            {
                                label: "Sales Analytics",
                                backgroundColor: "rgba(69, 203, 133, 0.8)",
                                borderColor: "rgba(69, 203, 133, 0.8)",
                                borderWidth: 1,
                                hoverBackgroundColor: "rgba(69, 203, 133, 0.9)",
                                hoverBorderColor: "rgba(69, 203, 133, 0.9)",
                                data: [65, 59, 81, 45, 56, 80, 50, 20],
                            },
                        ],
                    },
                    { scales: { xAxes: [{ barPercentage: 0.4 }] } }
                ),
                this.respChart(d("#radar"), "Radar", {
                    labels: [
                        "Eating",
                        "Drinking",
                        "Sleeping",
                        "Designing",
                        "Coding",
                        "Cycling",
                        "Running",
                    ],
                    datasets: [
                        {
                            label: "Desktops",
                            backgroundColor: "rgba(238, 185, 2, 0.2)",
                            borderColor: "#EEB902",
                            pointBackgroundColor: "#EEB902",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#EEB902",
                            data: [65, 59, 90, 81, 56, 55, 40],
                        },
                        {
                            label: "Tablets",
                            backgroundColor: "rgba(69, 203, 133, 0.2)",
                            borderColor: "#45cb85",
                            pointBackgroundColor: "#45cb85",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#45cb85",
                            data: [28, 48, 40, 19, 96, 27, 100],
                        },
                    ],
                });
            this.respChart(d("#polarArea"), "PolarArea", {
                datasets: [
                    {
                        data: [11, 16, 7, 18],
                        backgroundColor: [
                            "#ff715b",
                            "#45cb85",
                            "#eeb902",
                            "#3b5de7",
                        ],
                        label: "My dataset",
                        hoverBorderColor: "#fff",
                    },
                ],
                labels: ["Series 1", "Series 2", "Series 3", "Series 4"],
            });
        }),
        (d.ChartJs = new r()),
        (d.ChartJs.Constructor = r);
})(window.jQuery),
    (function () {
        "use strict";
        document.addEventListener('DOMContentLoaded', () => {
            // window.jQuery.ChartJs.init();
        });
    })();
