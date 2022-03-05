$("#checkedAll").change( function() {
    var i = 0;
    if(this.checked) {
    $(".checkSingle").each(function() {
        i++;
        $('#contact_count').text(i);
        this.checked=true;
        $("#submit_button").prop("disabled", false);
    })              
    } else {
        $(".checkSingle").each(function() {
            $('#contact_count').text(i);
            this.checked=false;
            $("#submit_button").attr("disabled", true);
        })              
    }
});

$(".checkSingle").click(function () {
var count = $(".checkSingle:checked").length;
$('#contact_count').text(count);

if( count < 1) {
    $("#submit_button").prop("disabled", true);
}

if ($(this).is(":checked")) {
    var isAllChecked = 0;
    $(".checkSingle").each(function(){
        if(!this.checked) {
            isAllChecked = 1;
            $("#submit_button").prop("disabled", false); 
        }
    })              
    if(isAllChecked == 0) { 
        $("#checkedAll").prop("checked", true);
    }     
    } else {
        $("#checkedAll").prop("checked", false);
    }
});






Circles.create({
    id:'circles-1',
    radius:45,
    value:60,
    maxValue:100,
    width:7,
    text: 5,
    colors:['#f1f1f1', '#FF9E27'],
    duration:400,
    wrpClass:'circles-wrp',
    textClass:'circles-text',
    styleWrapper:true,
    styleText:true
})

Circles.create({
    id:'circles-2',
    radius:45,
    value:70,
    maxValue:100,
    width:7,
    text: 36,
    colors:['#f1f1f1', '#2BB930'],
    duration:400,
    wrpClass:'circles-wrp',
    textClass:'circles-text',
    styleWrapper:true,
    styleText:true
})

Circles.create({
    id:'circles-3',
    radius:45,
    value:40,
    maxValue:100,
    width:7,
    text: 12,
    colors:['#f1f1f1', '#F25961'],
    duration:400,
    wrpClass:'circles-wrp',
    textClass:'circles-text',
    styleWrapper:true,
    styleText:true
})

var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

var mytotalIncomeChart = new Chart(totalIncomeChart, {
    type: 'bar',
    data: {
        labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
        datasets : [{
            label: "Total Income",
            backgroundColor: '#ff9e27',
            borderColor: 'rgb(23, 125, 255)',
            data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                ticks: {
                    display: false //this will remove only the label
                },
                gridLines : {
                    drawBorder: false,
                    display : false
                }
            }],
            xAxes : [ {
                gridLines : {
                    drawBorder: false,
                    display : false
                }
            }]
        },
    }
});

$('#lineChart').sparkline([105,103,123,100,95,105,115], {
    type: 'line',
    height: '70',
    width: '100%',
    lineWidth: '2',
    lineColor: '#ffa534',
    fillColor: 'rgba(255, 165, 52, .14)'
});