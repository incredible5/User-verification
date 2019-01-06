function dropShow(x)
{
	if(document.getElementById(x).style.display == "block")
		document.getElementById(x).style.display = "none";
	else
    {
    	closeAll();
    	document.getElementById(x).style.display = "block";
    }
}
window.onclick = function(event)
{
	// console.log(event.target.matches('.hamburger'));
	// console.log(event.target.matches('#menu'));
	// console.log(event.target.matches('.navibar'));
	// if(!(event.target.matches('.navibar') || event.target.matches('.menu')))
    // closeAll();
}
function closeAll()
{
	document.getElementById("menu").style.display = "none";
}