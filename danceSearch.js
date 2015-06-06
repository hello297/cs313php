function searchData()
{
	$.ajax({
		success: 
			function()
			{
				$( "#data").html( "<strong>Sup Bro</strong>" );
			}
	});
}

function update(which)
{
	$.post("danceSearch.php", {search: $("#search").val(), which: which}, function(data) {
		$( "#data").html(data);
	});
}

function logout()
{
	$.post("unset.php", {}, function() {
	});
}

function register()
{
	if ($("#name").val() != '' && $("#desc").val() != '' && $("#style").val() != '')
	{
		$.post("register.php", {name: $("#name").val(), desc: $("#desc").val(), code: $("#code").val(), start: $("#start").val(), end: $("#end").val(), style: $("#style").val(), coolness: $("#coolness").val(), hardness: $("#hardness").val()}, function(data) {
			alert(data);
		});	
	}
	else
	{
		alert("Please enter the starred fields");
	}
}

function display(rating)
{
	var which= rating + "Label";
	document.getElementById(which).innerHTML = document.getElementById(rating).value;
}

function add(id)
{
	var cool = prompt("Enter a number 1-10 for coolness", "1");
	var hard = prompt("Enter a number 1-10 for hardness", "1");
	$.post('add.php', {move_id: id, cool: cool, hard: hard}, function(data){
		alert(data);
	});
}

function remove(id)
{
	$.post('delete.php', {move_id: id}, function(data){
		alert(data);
	});
//	location.reload();
}