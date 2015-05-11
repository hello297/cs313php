function validateForm()
{
	if (document.myForm.dance.value != "" && document.myForm.color.value != "" && document.myForm.animal.value != "" && document.myForm.mac.value != "")
	{
		return true;
	}
	else
	{
		alert("You must fill out the form to submit");
		return false;
	}
}

function youDontSay(whynot)
{
	document.getElementById(whynot).src="whynot.jpg";
	document.getElementById(whynot).alt="WHY NOT!";
	window.scrollBy(0, 100);
}