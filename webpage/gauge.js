/**
 * --------------------------------------------------------
 * This demo was created using amCharts V4 preview release.
 *
 * V4 is the latest installement in amCharts data viz
 * library family, to be released in the first half of
 * 2018.
 *
 * For more information and documentation visit:
 * https://www.amcharts.com/docs/v4/
 * --------------------------------------------------------
 */





 var script = document.createElement('script');
 script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
 script.type = 'text/javascript';
 document.getElementsByTagName('head')[0].appendChild(script);



var datain;
 $.ajax(
  'database_connect.php',
  {
      async: false,
      success: function(data) {
          //document.getElementById("ovdje").innerHTML = data;
          datain = data;
          // console.log(datain);
          // console.log(typeof(datain));
      },
      error: function() {
          alert('There was some error performing the AJAX call!');
      }
  }
);

var data_values = datain.split(' ');
// console.log(data_values);
var behelterNiveau = parseInt(data_values[4]);
var behelterMax = parseInt(data_values[5]);
var behelterMin = parseInt(data_values[6]);
var tempNiveau = parseInt(data_values[7]);
var tempMax = parseInt(data_values[8]);
var tempMin = parseInt(data_values[9]);

// console.log(behelterNiveau);
// console.log(behelterMax);
// console.log(behelterMin);
// console.log(tempNiveau);
// console.log(tempMax);
// console.log(tempMin);





 am4core.useTheme(am4themes_animated);

 // create chart
 var chart = am4core.create("chartdiv", am4charts.GaugeChart);
 chart.innerRadius = -15;
 
 var axis = chart.xAxes.push(new am4charts.ValueAxis());
 axis.min = 0;
 axis.max = 100;
 axis.strictMinMax = true;
 axis.renderer.inside = true;
 //axis.renderer.ticks.template.inside = true;
 //axis.stroke = am4core.color("#67b7dc");
 axis.renderer.radius = am4core.percent(100);
 //axis.renderer.radius = 80;
 axis.renderer.line.strokeOpacity = 1;
 axis.renderer.line.strokeWidth = 5;
 axis.renderer.line.stroke = am4core.color("#fdd400");
 axis.renderer.ticks.template.stroke = am4core.color("#fdd400");
 axis.renderer.labels.template.radius = 35;
 axis.renderer.ticks.template.strokeOpacity = 1;
 axis.renderer.grid.template.disabled = true;
 axis.renderer.ticks.template.length = 10;
 
 var hand = chart.hands.push(new am4charts.ClockHand());
 hand.fill = 'cyan';
 hand.stroke = 'cyan';
 hand.opacity = 0.6;
 hand.pin.radius = 10;
 hand.startWidth = 10;
 var hand2 = chart.hands.push(new am4charts.ClockHand());
 hand2.fill = 'red';
 hand2.stroke = 'red';
 hand2.opacity = 0.6;
 hand2.pin.radius = 10;
 hand2.startWidth = 10;
 var hand3 = chart.hands.push(new am4charts.ClockHand());
 hand3.fill = axis.renderer.line.stroke;
 hand3.stroke = axis.renderer.line.stroke;
 hand3.pin.radius = 10;
 hand3.startWidth = 10;
 
//  setInterval(() => {
//    hand.showValue(behelterMin, 500, am4core.ease.cubicOut);
//    hand2.showValue(behelterMax, 500, am4core.ease.cubicOut);
//    hand3.showValue(behelterNiveau, 1000, am4core.ease.cubicOut);
//  }, 600);

hand.showValue(behelterMin, am4core.ease.cubicOut);
hand2.showValue(behelterMax, am4core.ease.cubicOut);
hand3.showValue(behelterNiveau, am4core.ease.cubicOut);


 // temp chart

 var chart_temp = am4core.create("chartdiv_temp", am4charts.GaugeChart);
 chart_temp.innerRadius = -15;
 
 var axis_temp = chart_temp.xAxes.push(new am4charts.ValueAxis());
 axis_temp.min = 0;
 axis_temp.max = 100;
 axis_temp.strictMinMax = true;
 axis_temp.renderer.inside = true;
 //axis.renderer.ticks.template.inside = true;
 //axis.stroke = am4core.color("#67b7dc");
 axis_temp.renderer.radius = am4core.percent(100);
 //axis.renderer.radius = 80;
 axis_temp.renderer.line.strokeOpacity = 1;
 axis_temp.renderer.line.strokeWidth = 5;
 axis_temp.renderer.line.stroke = am4core.color("#fdd400");
 axis_temp.renderer.ticks.template.stroke = am4core.color("#fdd400");
 axis_temp.renderer.labels.template.radius = 35;
 axis_temp.renderer.ticks.template.strokeOpacity = 1;
 axis_temp.renderer.grid.template.disabled = true;
 axis_temp.renderer.ticks.template.length = 10;
 
 var hand_temp = chart_temp.hands.push(new am4charts.ClockHand());
 hand_temp.fill = 'cyan';
 hand_temp.stroke = 'cyan';
 hand_temp.opacity = 0.6;
 hand_temp.pin.radius = 10;
 hand_temp.startWidth = 10;
 var hand2_temp = chart_temp.hands.push(new am4charts.ClockHand());
 hand2_temp.fill = 'red';
 hand2_temp.stroke = 'red';
 hand2_temp.opacity = 0.6;
 hand2_temp.pin.radius = 10;
 hand2_temp.startWidth = 10;
 var hand3_temp = chart_temp.hands.push(new am4charts.ClockHand());
 hand3_temp.fill = axis.renderer.line.stroke;
 hand3_temp.stroke = axis.renderer.line.stroke;
 hand3_temp.pin.radius = 10;
 hand3_temp.startWidth = 10;
 
//  setInterval(() => {
//    hand_temp.showValue(tempMin, 500, am4core.ease.cubicOut);
//    hand2_temp.showValue(tempMax, 500, am4core.ease.cubicOut);
//    hand3_temp.showValue(tempNiveau, 1000, am4core.ease.cubicOut);
//  }, 600);

hand_temp.showValue(tempMin, am4core.ease.cubicOut);
hand2_temp.showValue(tempMax, am4core.ease.cubicOut);
hand3_temp.showValue(tempNiveau, am4core.ease.cubicOut);


function amchart() {
  $.ajax(
    'database_connect.php',
    {
        async: false,
        success: function(data) {
            //document.getElementById("ovdje").innerHTML = data;
            datain = data;
            // console.log(datain);
            // console.log(typeof(datain));
        },
        error: function() {
            alert('There was some error performing the AJAX call!');
        }
    }
  );
  
  var data_values = datain.split(' ');
  // console.log(data_values);
  var behelterNiveau = parseInt(data_values[4]);
  var behelterMax = parseInt(data_values[5]);
  var behelterMin = parseInt(data_values[6]);
  var tempNiveau = parseInt(data_values[7]);
  var tempMax = parseInt(data_values[8]);
  var tempMin = parseInt(data_values[9]);


  hand.showValue(behelterMin, am4core.ease.cubicOut);
  hand2.showValue(behelterMax, am4core.ease.cubicOut);
  hand3.showValue(behelterNiveau, am4core.ease.cubicOut);

  hand_temp.showValue(tempMin, am4core.ease.cubicOut);
  hand2_temp.showValue(tempMax, am4core.ease.cubicOut);
  hand3_temp.showValue(tempNiveau, am4core.ease.cubicOut);

}

function repeatEverySecond() {
  intervalID = setInterval(amchart, 3000);
}

repeatEverySecond();