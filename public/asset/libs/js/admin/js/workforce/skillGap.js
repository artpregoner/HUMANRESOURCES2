// Workforce Analytics Chart (Bar Chart)
const ctxWorkforce = document.getElementById('workforce-chart').getContext('2d');
const workforceChart = new Chart(ctxWorkforce, {
    type: 'bar',
    data: {
        labels: ['Finance', 'Marketing', 'Sales', 'Human Resources'],
        datasets: [{
            label: 'Employees',
            data: [50, 75, 50, 80],
            backgroundColor: '#c28251'
        }]
    }
});

// Skills Distribution Chart (Doughnut Chart)
const ctxSkills = document.getElementById('skills-chart').getContext('2d');
const skillsChart = new Chart(ctxSkills, {
    type: 'doughnut',
    data: {
        labels: ['Finance', 'Marketing', 'Sales', 'Human Resources'],
        datasets: [{
            label: 'Skills Distribution',
            data: [50, 75, 50, 80],
            backgroundColor: ['#d19b68', '#ffa659', '#c79870', '#c28251']
        }]
    }
});
    // ============================================================== 
    // Chart Balance Bar
    // ============================================================== 
    var ctx = document.getElementById("chartjs_balance_bar").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',

        
        data: {
            labels: ["Marketing", "Logistics", "Human Resources", "Finance", "Accounting"],
            datasets: [{
                label: 'Value',
                data: [1, 0.5, 0.5, 0.25, 1],
                backgroundColor: "rgba(89, 105, 255,.8)",
                borderColor: "rgba(89, 105, 255,1)",
                borderWidth:2

            }], 
            // {
            //     label: 'Aged Receiables',
            //     data: [1000, 1500, 2500, 3500, 2500],
            //     backgroundColor: "rgba(255, 64, 123,.8)",
            //     borderColor: "rgba(255, 64, 123,1)",
            //     borderWidth:2


            // }]

        },
        options: {
            legend: {
                    display: true,

                    position: 'bottom',

                    labels: {
                        fontColor: '#71748d',
                        fontFamily:'Circular Std Book',
                        fontSize: 14,
                    }
            },

                scales: {
                    xAxes: [{
                ticks: {
                    fontSize: 14,
                     fontFamily:'Circular Std Book',
                     fontColor: '#71748d',
                }
            }],
            yAxes: [{
                ticks: {
                    fontSize: 14,
                     fontFamily:'Circular Std Book',
                     fontColor: '#71748d',
                }
            }]
                }
    }



});

document.getElementById('skill-gap-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const department = document.getElementById('department').value;
    const skill = document.getElementById('skill').value;
    const level = document.getElementById('level').value;
    const skillGap = calculateGap(level);

    const resultBody = document.getElementById('result-body');
    resultBody.innerHTML = `
        <tr>
            <td>${skill}</td>
            <td>${level}</td>
            <td>${skillGap}</td>
        </tr>
    `;

    const recommendations = document.getElementById('recommendations-list');
    recommendations.innerHTML = `
        <li>Consider enrolling in advanced ${skill} courses for ${department}.</li>
        <li>Attend webinars to enhance ${skill} proficiency.</li>
    `;
});

function calculateGap(level) {
    switch (level) {
        case 'Beginner': return 'High';
        case 'Intermediate': return 'Moderate';
        case 'Advanced': return 'Low';
        default: return 'Unknown';
    }
}

// Dummy charts using Chart.js library
