<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"       type="text/javascript"></script> 	
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
  
  <script type="text/javascript">
	  
	  function isItemInArray(array, item) {
	      for (var i = 0; i < array.length; i++) {
	          // This if statement depends on the format of your array
	          if (array[i][0] == item[0] && array[i][1] == item[1]) {
	              return true;   // Found it
	          }
	      }
	      return false;   // Not found
	  }
	  
	  
	  
  var filePath = "./repo.txt"
  xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET",filePath,false);
  xmlhttp.send(null);
  var fileContent = xmlhttp.responseText;
  
  var json_obj = fileContent.split('\n');
  
  
  
  
//after this for loop, json_obj should be an array of json objects    
for(var i=0;i<json_obj.length-1; i++){
	json_obj[i] = JSON.parse(json_obj[i]);	
}

var languages = Array();
var numOfTrue;
var totalCount = 0;

for(var i = 0; i < json_obj.length; i++){
		numOfTrue = 0;
		for(var j=0;j<json_obj.length;j++){
		    if(JSON.stringify(json_obj[i].language) == JSON.stringify(json_obj[j].language)){
		       numOfTrue++;
			}
		}
		
		
		if (!isItemInArray(languages,[json_obj[i].language, numOfTrue])) {
			if(json_obj[i].language == null){
			}
			else{
				totalCount += numOfTrue;				
				languages.push([json_obj[i].language, numOfTrue]);
			}
		
		}
		
		languages[0].sliced = true;
		languages[0].selected = true;
		
		
		numOfTrue = 0;
		
	}
	
  $(document).ready(function() {

      var options = {
          chart: {
              renderTo: 'container',
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false
          },
          title: {
              text: 'Query Results by Language'
          },
		  tooltip: {
		              formatter: function() {
                          return '<b>'+ "Number of " +this.point.name + " documents: " + '</b>:'+ Highcharts.numberFormat(this.percentage*totalCount/100, 0);
		              }
					  },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      color: '#000000',
                      connectorColor: '#000000',
                      formatter: function() {
                          return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %';
                      }
                  }
              }
          },
          series: [{
              type: 'pie',
              name: 'Percent of Query',
			  data: languages}
  			]
  		}

          var chart = new Highcharts.Chart(options);
		  
		  

  }); 
  //Now do whatever you need with the array
  </script>



</head>
<body>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
 </body>
</html>