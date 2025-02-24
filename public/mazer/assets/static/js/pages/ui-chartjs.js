var ctxBar = document.getElementById("presence").getContext("2d");
var myBar = new Chart(ctxBar, {
  type: "bar",
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [
      {
        label: "Total",
        backgroundColor: "#57CAEB",
        borderColor: "rgba(63,82,227,1)",
        data: [],
      },
    ],
  },
  options: {
    responsive: true,
    
    title: {
      display: true,
      text: "Presence Data",
    },
    legend: {
      display: false,
    },
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
            suggestedMax: 40 + 20,
            padding: 10,
          },
          gridLines: {
            drawBorder: false,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
    },
  },
});

// Update dataset from API.
function updateData() {
  fetch("dashboard/presence")
    .then((response) => response.json())
    .then((output) => {
      myBar.data.datasets = [
        {
          label: "Total",
          backgroundColor: "#57CAEB",
          borderColor: "rgba(63,82,227,1)",
          data: output,
        },
      ];
      myBar.update();
    });
}

updateData();

var line = document.getElementById("payroll").getContext("2d")
var gradient = line.createLinearGradient(0, 0, 0, 400)
gradient.addColorStop(0, "rgba(50, 69, 209,1)")
gradient.addColorStop(1, "rgba(265, 177, 249,0)")

var gradient2 = line.createLinearGradient(0, 0, 0, 400)
gradient2.addColorStop(0, "rgba(255, 91, 92,1)")
gradient2.addColorStop(1, "rgba(265, 177, 249,0)")

var myline = new Chart(line, {
  type: "line",
  data: {
    labels: [
      "16-07-2025",
      "17-07-2025",
      "18-07-2025",
      "19-07-2025",
      "20-07-2025",
      "21-07-2025",
      "22-07-2025",
      "23-07-2025",
      "24-07-2025",
      "25-07-2025",
    ],
    datasets: [
      {
        label: "Balance",
        data: [50, 25, 61, 50, 72, 52, 60, 41, 30, 45],
        backgroundColor: "rgba(50, 69, 209,.6)",
        borderWidth: 3,
        borderColor: "rgba(63,82,227,1)",
        pointBorderWidth: 0,
        pointBorderColor: "transparent",
        pointRadius: 3,
        pointBackgroundColor: "transparent",
        pointHoverBackgroundColor: "rgba(63,82,227,1)",
      },
      {
        label: "Balance",
        data: [20, 35, 45, 75, 37, 86, 45, 65, 25, 53],
        backgroundColor: "rgba(253, 183, 90,.6)",
        borderWidth: 3,
        borderColor: "rgba(253, 183, 90,.6)",
        pointBorderWidth: 0,
        pointBorderColor: "transparent",
        pointRadius: 3,
        pointBackgroundColor: "transparent",
        pointHoverBackgroundColor: "rgba(63,82,227,1)",
      },
    ],
  },
  options: {
    responsive: true,
    layout: {
      padding: {
        top: 10,
      },
    },
    tooltips: {
      intersect: false,
      titleFontFamily: "Helvetica",
      titleMarginBottom: 10,
      xPadding: 10,
      yPadding: 10,
      cornerRadius: 3,
    },
    legend: {
      display: true,
    },
    scales: {
      yAxes: [
        {
          gridLines: {
            display: true,
            drawBorder: true,
          },
          ticks: {
            display: true,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
    },
  }
});