$('#arrival').click(function() {
	var now = new Date();
	var month = now.getMonth() + 1;
	var trueMonth = (month < 10) ? '0' + month : month;
	var nowDate = now.getFullYear() + '-' + trueMonth + '-' + now.getDate();
// alert( nowDate );
  $.ajax({
    'url' : '/../api/airports.schedule.php',
    'type' : 'POST',
    'data' : {
      'token' : '123',
      'airport' : 'SVO',
      'date' : nowDate,
      'event' : 'arrival'
    },
    'success' : function(data) {
	    var table = "";
 	    for (var i = 0; i < data.response.length; i++){
	 	    var dataRow = data.response[i];
	 	    var terminal = (dataRow.terminal == null) ? '' : dataRow.terminal;
	 	    var row = '<tr><td><img width="64" src="../images/airlines/SU-iata.png"></td><td>' + dataRow.number + '</td><td>' + dataRow.title + '</td><td>' + terminal + '</td><td>' + dataRow.arrival + '</td><td>Вылетел</td></tr>';
	 	    console.log(row);
	 	    table = table + row;
 	    }
		$('#data-schedule').html(table);
		
		var flightType = "Прилеты " + nowDate;
		$('#type_flights').html(flightType);
	    console.log(data.response.length);
	    //alert(data.response.length);
    }
  });
});

$('#departure').click(function() {
	var now = new Date();
	var month = now.getMonth() + 1;
	var trueMonth = (month < 10) ? '0' + month : month;
	var nowDate = now.getFullYear() + '-' + trueMonth + '-' + now.getDate();
// alert( nowDate );
  $.ajax({
    'url' : '/../api/airports.schedule.php',
    'type' : 'POST',
    'data' : {
      'token' : '123',
      'airport' : 'SVO',
      'date' : nowDate,
      'event' : 'departure'
    },
    'success' : function(data) {
	    var table = "";
 	    for (var i = 0; i < data.response.length; i++){
	 	    var dataRow = data.response[i];
	 	    var terminal = (dataRow.terminal == null) ? '' : dataRow.terminal;
	 	    var row = '<tr><td><img width="64" src="../images/airlines/SU-iata.png"></td><td>' + dataRow.number + '</td><td>' + dataRow.title + '</td><td>' + terminal + '</td><td>' + dataRow.departure + '</td><td>Вылетел</td></tr>';
	 	    console.log(row);
	 	    table = table + row;
 	    }
		$('#data-schedule').html(table);
		
		var flightType = "Вылеты " + nowDate;
		$('#type_flights').html(flightType);
	    console.log(data.response.length);
	    //alert(data.response.length);
    }
  });
});