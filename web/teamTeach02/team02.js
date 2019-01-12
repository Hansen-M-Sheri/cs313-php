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

