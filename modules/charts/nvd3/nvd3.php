<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="html/nvd3/build/nv.d3.css" rel="stylesheet" type="text/css">
    <script src="html/nvd3/d3.min.js" charset="utf-8"></script>
    <script src="html/nvd3/build/nv.d3.js"></script>
 

    <style>
        text {
            font: 12px sans-serif;
        }
        svg {
            display: block;
        }
       #chart1, svg {
            margin: 0px;
            padding: 0px;
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="chart1" class='with-3d-shadow with-transitions'>
    <svg></svg>
</div>

<script>
var start = +new Date();
function getUrlVars() {
       var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	    vars[key] = value;
    });
    return vars;
    }
   
    var type = getUrlVars()["type"];
    var max = getUrlVars()["max"];
    var single = getUrlVars()["single"];
    var group = getUrlVars()["group"];
    var mode = getUrlVars()["mode"];
    
    if (typeof group === 'undefined') {
		var group = "";
	 }
	 if (typeof mode === 'undefined') {
		var mode = "";
	 }
	 if (typeof single === 'undefined') {
		var single = "";
	 }

d3.json('common/nvd3_data.php?type='+type+'&name='+name+'&max='+max+'&mode='+mode+'&group='+group+'&single='+single, function(data) {
  nv.addGraph(function() {
  	var chart = nv.models.lineWithFocusChart()
        .x(function(d) { return d.label })
        .y(function(d) { return d.value })
        .margin({top: 30, right: 20, bottom: 50, left: 50})
        .useInteractiveGuideline(true)


    chart.yAxis
        .tickFormat(d3.format(',.2f'));
        

        
    chart.xAxis
    .tickFormat(function(d) {
      return d3.time.format('%m/%d %X')(new Date(d))
    });
    
    chart.x2Axis
    .tickFormat(function(d) {
      return d3.time.format('%m/%d ')(new Date(d))
    });

    d3.select('#chart1 svg')
        .datum(data)
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });
});

</script>
</body>
</html>