document.addEventListener('DOMContentLoaded', function() {
    const data = [
        { month: 'Jan', hired: 20, left: 10 },
        { month: 'Feb', hired: 25, left: 8 },
        { month: 'Mar', hired: 30, left: 12 },
        { month: 'Apr', hired: 22, left: 15 },
        { month: 'May', hired: 28, left: 11 },
        { month: 'Jun', hired: 35, left: 9 }
    ];

    const subgroups = ['hired', 'left'];
    const color = d3.scaleOrdinal()
        .domain(subgroups)
        .range(['#82ca9d', '#ff7300']);

    function createChart() {
        d3.select("#employee-turnover-chart").selectAll("*").remove();

        const chartContainer = document.getElementById('employee-turnover-chart');
        const width = chartContainer.offsetWidth;
        const height = chartContainer.offsetHeight;
        const margin = {top: 20, right: 30, bottom: 40, left: 40};
        const chartWidth = width - margin.left - margin.right;
        const chartHeight = height - margin.top - margin.bottom;

        const svg = d3.select("#employee-turnover-chart")
            .append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        const x = d3.scaleBand()
            .range([0, chartWidth])
            .padding(0.1);

        const y = d3.scaleLinear()
            .range([chartHeight, 0]);

        x.domain(data.map(d => d.month));
        y.domain([0, d3.max(data, d => Math.max(d.hired, d.left))]);

        svg.append("g")
            .attr("transform", `translate(0,${chartHeight})`)
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "rotate(-45)")
            .style("text-anchor", "end");

        svg.append("g")
            .call(d3.axisLeft(y));

        const tooltip = d3.select("body").append("div")
            .attr("class", "tooltip")
            .style("opacity", 0);

        const stackedData = d3.stack()
            .keys(subgroups)(data);

        svg.append("g")
            .selectAll("g")
            .data(stackedData)
            .enter().append("g")
            .attr("fill", d => color(d.key))
            .selectAll("rect")
            .data(d => d)
            .enter().append("rect")
            .attr("x", d => x(d.data.month))
            .attr("y", d => y(d[1]))
            .attr("height", d => y(d[0]) - y(d[1]))
            .attr("width", x.bandwidth())
            .attr("class", "bar")
            .on("mouseover", function(event, d) {
                const subgroupName = d3.select(this.parentNode).datum().key;
                const subgroupValue = d.data[subgroupName];
                tooltip.transition()
                    .duration(200)
                    .style("opacity", .9);
                tooltip.html(subgroupName + ": " + subgroupValue)
                    .style("left", (event.pageX) + "px")
                    .style("top", (event.pageY - 28) + "px");
            })
            .on("mouseout", function(d) {
                tooltip.transition()
                    .duration(500)
                    .style("opacity", 0);
            });
    }
    function createLegend() {
        const legend = d3.select("#employee-turnover-legend");
        legend.selectAll("*").remove();

        subgroups.forEach((key, index) => {
            const legendItem = legend.append("div")
                .attr("class", "legend-item");

            legendItem.append("div")
                .attr("class", "legend-color")
                .style("background-color", color(key));

            legendItem.append("span")
                .text(key === 'hired' ? 'New Hires' : 'Employees Left');
        });
    }

    createChart();
    createLegend();

    window.addEventListener('resize', function() {
        createChart();
    });


    // Function for Absenteeism Rate Chart
function createAbsenteeismRateChart() {
    const absenteeismData = [
        { month: 'Jan', rate: 2.5 },
        { month: 'Feb', rate: 3.1 },
        { month: 'Mar', rate: 2.8 },
        { month: 'Apr', rate: 3.5 },
        { month: 'May', rate: 2.9 },
        { month: 'Jun', rate: 3.0 }
    ];

    const margin = { top: 20, right: 30, bottom: 40, left: 50 };
    const chartContainer = document.getElementById('absenteeism-rate-chart');
    const width = chartContainer.offsetWidth - margin.left - margin.right;
    const height = 300 - margin.top - margin.bottom;

    const svg = d3.select("#absenteeism-rate-chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Scales
    const x = d3.scaleBand()
        .domain(absenteeismData.map(d => d.month))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(absenteeismData, d => d.rate)])
        .range([height, 0]);

    // X Axis
    svg.append("g")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x))
        .selectAll("text")
        .attr("transform", "rotate(-45)")
        .style("text-anchor", "end");

    // Y Axis
    svg.append("g")
        .call(d3.axisLeft(y));

    // Bars
    svg.selectAll(".bar")
        .data(absenteeismData)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", d => x(d.month))
        .attr("y", d => y(d.rate))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.rate))
        .attr("fill", "#69b3a2");

    // Tooltip (optional)
    const tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    svg.selectAll(".bar")
        .on("mouseover", function(event, d) {
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html("Absenteeism: " + d.rate + "%")
                .style("left", (event.pageX) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function() {
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });

    // Legend (optional)
    const legend = d3.select("#absenteeism-rate-legend");
    legend.selectAll("*").remove();

    const legendItem = legend.append("div")
        .attr("class", "legend-item");

    legendItem.append("div")
        .attr("class", "legend-color")
        .style("background-color", "#69b3a2");

    legendItem.append("span")
        .text("Absenteeism Rate (%)");
}

// Call the Absenteeism Rate Chart function
document.addEventListener('DOMContentLoaded', function() {
    createAbsenteeismRateChart();
});

});


// Function for Absenteeism Rate Chart
// Function for Absenteeism Rate Chart
function createAbsenteeismRateChart() {
    const absenteeismData = [
        { month: 'Jan', rate: 2.5 },
        { month: 'Feb', rate: 3.1 },
        { month: 'Mar', rate: 2.8 },
        { month: 'Apr', rate: 3.5 },
        { month: 'May', rate: 2.9 },
        { month: 'Jun', rate: 3.0 }
    ];

    const margin = { top: 20, right: 30, bottom: 40, left: 50 };
    const chartContainer = document.getElementById('absenteeism-rate-chart');
    let width = chartContainer.offsetWidth - margin.left - margin.right;
    let height = 300 - margin.top - margin.bottom;

    // Clear previous SVG for resizing
    d3.select("#absenteeism-rate-chart").selectAll("*").remove();

    const svg = d3.select("#absenteeism-rate-chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Scales
    const x = d3.scaleBand()
        .domain(absenteeismData.map(d => d.month))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(absenteeismData, d => d.rate)])
        .range([height, 0]);

    // X Axis
    svg.append("g")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x))
        .selectAll("text")
        .attr("transform", "rotate(-45)")
        .style("text-anchor", "end");

    // Y Axis
    svg.append("g")
        .call(d3.axisLeft(y));

    // Bars
    svg.selectAll(".bar")
        .data(absenteeismData)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", d => x(d.month))
        .attr("y", d => y(d.rate))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.rate))
        .attr("fill", "#69b3a2");

    // Tooltip
    const tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    svg.selectAll(".bar")
        .on("mouseover", function(event, d) {
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html("Absenteeism: " + d.rate + "%")
                .style("left", (event.pageX) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function() {
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });

    // Legend
    const legend = d3.select("#absenteeism-rate-legend");
    legend.selectAll("*").remove();

    const legendItem = legend.append("div")
        .attr("class", "legend-item");

    legendItem.append("div")
        .attr("class", "legend-color")
        .style("background-color", "#69b3a2");

    legendItem.append("span")
        .text("Absenteeism Rate (%)");

    // Resize the chart on window resize
    window.addEventListener('resize', function() {
        const newWidth = chartContainer.offsetWidth - margin.left - margin.right;
        if (newWidth !== width) {
            width = newWidth;
            d3.select("#absenteeism-rate-chart").select("svg").remove();
            createAbsenteeismRateChart();  // Re-draw chart on resize
        }
    });
}

// Call the Absenteeism Rate Chart function

// var chart = c3.generate({
//     bindto: "#department-category",
//     data: {
//         columns: [
//             ['TotalEmployee', 4],
//             ['NewHires', 4],
//             ['TurnoverRate', 10],
//             ['HelpdeskTickets', 10],
//             ['SystemDevelopment', 30],

//         ],
//         type: 'donut',

//         onclick: function(d, i) { console.log("onclick", d, i); },
//         onmouseover: function(d, i) { console.log("onmouseover", d, i); },
//         onmouseout: function(d, i) { console.log("onmouseout", d, i); },

//         colors: {
//             TotalEmployee: '#5969ff',
//             NewHires: '#ff407b',
//             TurnoverRate: '#25d5f2',
//             HelpdeskTickets: '#ffc750',
//             SystemDevelopment: '#2ec551',



//         }
//     },
//     donut: {
//         label: {
//             show: false
//         }
//     },



// });
    var chart = new Chartist.Pie('.ct-chart-category', {
        series: [60, 30, 30],
        labels: ['Bananas', 'Apples', 'Grapes']
    }, {
        donut: true,
        showLabel: false,
        donutWidth: 40

    });
    var chart = new Chartist.Pie('.employee', {
        series: [60, 30, 30],
        labels: ['Bananas', 'Apples', 'Grapes']
    }, {
        donut: true,
        showLabel: false,
        donutWidth: 40

    });

        // ============================================================== 
    //  chart bar horizontal
    // ============================================================== 

    