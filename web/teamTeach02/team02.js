
function clicked(){
	alert("Clicked");
}

//using javascript/jquery to change background color of div1 from input
function changeDiv1Color(){
  // var color = document.getElementById("div1Color").value;
  var color = $("input:text").val();
  //set color for div1
 // document.getElementById("div1").style.backgroundColor = color;
 $('#div1').css("background-color", color);
}

//toggle hide/show div 3 when clicked
function toggleHideDiv3(){
  var div = document.getElementById("div3");
  if (div.style.display == "none" ) {
    // div.style.display = "block";
    $('#div3').fadeIn('slow');
  }
  else {
   
    // div.style.display = "none";
     $('#div3').fadeOut('slow');
  }
  
}
