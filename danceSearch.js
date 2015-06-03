function searchData()
{
	$.ajax({
		success: 
			function()
			{
				$( "#data").html( "<strong>Sup Bro</strong>" );
			}
	});
	
	/*$.post("danceSearch.php", {name:"burton"}, function(data) {
		// This function is called when you get something back from the server
		alert("clicked: " + data);
	});	*/
}

function update()
{
	$.post("danceSearch.php", {search: $("#search").val()}, function(data) {
		$( "#data").html(data);
//		document.getElementById("data").innerHTML = data;
	});
}