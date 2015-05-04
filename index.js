function popUp(id)
{
//	document.getElementById(id).style.width="750px";
//	document.getElementById(id +"p").style.width="700px";
	document.getElementById(id).style.width="300px";
	document.getElementById(id + "p").style.display="block";	
}

function reduce(id)
{
	
	document.getElementById(id).style.width="300px";
	//document.getElementById(id + "h").style.width="300px";
	document.getElementById(id + "p").style.display="none";
}

function change(id)
{
	if (document.getElementById(id + "p").style.display=="block")
	{
		reduce(id);
	}
	else 
	{
		popUp(id);
	}
}