<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"       type="text/javascript"></script> 	
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

  
  <script>
	  var filePath = "./repo.txt"
	  xmlhttp = new XMLHttpRequest();
	  xmlhttp.open("GET",filePath,false);
	  xmlhttp.send(null);
	  var fileContent = xmlhttp.responseText;
  
	  var json_obj = fileContent.split('\n');
  
  
	  for(var i=0;i<json_obj.length-1; i++){
	  	json_obj[i] = JSON.parse(json_obj[i]);	
	  }
	  
	  var stars = [0, 0, 0, 0, 0, 0];  

  		for(var i = 0; i < json_obj.length; i++){
			if(json_obj[i].watchers < 5){
				stars[0]++;}
			
			else if(json_obj[i].watchers < 26){
				stars[1]++;}
			
			else if(json_obj[i].watchers < 101){
				stars[2]++;}
			
			else if(json_obj[i].watchers < 501){
				stars[3]++;}

			else if(json_obj[i].watchers < 2501){
				stars[4]++;}
				
			else{
				stars[5]++;}
			}
			
	  
	  
	  $(document).ready(function() {

	      var options = {
	          chart: {        
				  zoomType: 'xy',
	              renderTo: 'container',
	              plotBackgroundColor: null,
	              plotBorderWidth: null,
	              plotShadow: false,
			  	  type: 'column'
	  
	          },
	          title: {
	              text: 'Query Results by Number of Stars'
	          },
			  xAxis: {
			          categories: [
			              '<5',
			              '5-25',
			              '26-100',
			              '101-500',
			              '501-2500',
			              '2500+',
			          ],
					  
				      crosshair: true
				       },
			 yAxis: {
	           min: 0,
	           title: {
	               text: 'Number of Projects'
	           }
	       },
	       tooltip: {
	           headerFormat: '<span style="font-size:10px">{point.key}&#9734;</span><table>',
	           pointFormat: '<tr><td style="color:{point.color};padding:0">Number of Files: </td>' +
	           '<td style="color:{point.color}padding:0"><b>{point.y}</b></td></tr>',
	           shared: true,
				           useHTML: true
				       },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
			colorByPoint: true
			
   	 	}
	},
        series: [{
	              name: 'Attributed Stars',
				  data: stars}
	  			]
	  		}


	          var chart = new Highcharts.Chart(options);
			  
			  

	  });
	
  </script>



</head>
<body>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
 </body>
</html>