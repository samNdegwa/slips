$(function () {
getChart();
getLineGraph();
});

function getChart() {
  anychart.onDocumentReady(function() {   
 var data = [
    {x: "Successiful Messages", value: js_msg,
     normal: {
      fill: "#27A444"
     }

     },
    {x: "Failed Messages", value: js_nomsg, 
       normal: {
        fill: "#DC3545",
        hatchFill: "percent50"
      }
    }
    
];
var chart = anychart.pie()

  // set the chart title
  //chart.title("Successiful/Failed Messages");

  // add the data
  chart.data(data);

  // display the chart in the container
  chart.container('pieChart');
  chart.draw();

});
            } 


 function getLineGraph(){
    anychart.onDocumentReady(function() { 

     // create data
var data = [
  ["Jan", 50],
  ["Feb", 2563],
  ["Mar", 300],
  ["Apr", 670],
  ["May", 1032],
  ["Jun", 60],
  ["Jul", 198],
  ["Aug", 1204],
  ["Sep", 1032],
  ["Oct", 2156],
  ["Nov", 315],
  ["Dec", 0]
];
    
// create a chart
chart = anychart.line();
//chart.title("2020 Contacts trend");
// create a line series and set the data
var series = chart.line(data);

// set the container id
chart.container("linneGraph");

// initiate drawing the chart
chart.draw();
     });

   }         