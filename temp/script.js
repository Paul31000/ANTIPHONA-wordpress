window.onscroll = function() {scrollFunction()};
function scrollFunction() {
	if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
	  document.getElementById('myBtn').style.display = "block";
  } else {
	  document.getElementById('myBtn').style.display = "none";
  }
}

//Get the button:
mybutton = document.getElementById("myBtn");
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


function afficherMasquer(id)
{
  if(document.getElementById(1).style.display == "none")
    document.getElementById(1).style.display = "block";
  else
    document.getElementById(1).style.display = "none";
}