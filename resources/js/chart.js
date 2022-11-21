const { isNull } = require("lodash");

if (!isNull(document.getElementById('myChart'))) {
    const ctx = document.getElementById('myChart');

        
    //variabili di prova    
    let january = document.querySelectorAll('.gennaio').length;
    let february = document.querySelectorAll('.febbraio').length;
    let march = document.querySelectorAll('.marzo').length;
    let april = document.querySelectorAll('.aprile').length;
    let may = document.querySelectorAll('.maggio').length;
    let june = document.querySelectorAll('.giugno').length;
    let july = document.querySelectorAll('.luglio').length;
    let august = document.querySelectorAll('.agosto').length;
    let september = document.querySelectorAll('.settembre').length;
    let october = document.querySelectorAll('.ottobre').length;
    let november = document.querySelectorAll('.novembre').length;
    let december = document.querySelectorAll('.dicembre').length;
    //variabili di prova

    const plugin = {
    id: 'customCanvasBackgroundColor',
    beforeDraw: (chart, args, options) => {
            const {ctx} = chart;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = options.color || '#99ffff';
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
        }
    };

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

            datasets: [{
                label: 'Views',
                
                data: [
                    january,
                    february,
                    march,
                    april,
                    may,
                    june,
                    july,
                    august,
                    september,
                    october,
                    november,
                    december
                ],
            
                borderWidth: 1,
                backgroundColor: 'rgb(255, 255, 255)',
                borderColor: 'rgb(255, 255, 255)'
            }]
        },
        options: {
            plugins: {
                customCanvasBackgroundColor: {
                    color: 'rgb(0,0,0)',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        },

        plugins: [plugin]
    });
}
