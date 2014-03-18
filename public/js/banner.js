function addEvent() {
	alert("setup ");
	console.log""("setup ");
  var e = document.getElementsByTagName('nube_banner');
  		console.log""("eeeeeeeeeeeeeee "+e);
	  e.addEventListener("animationstart", listener, false);
	  e.addEventListener("animationend", listener, false);
	  e.addEventListener("animationiteration", listener, false);
}

	function listener(e) {
	  switch(e.type) {
	    case "animationstart":
	      console.log(e.elapsedTime);
	      break;
	    case "animationend":
	      console.log(e.elapsedTime);
	      break;
	    case "animationiteration":
	      console.log(e.elapsedTime);
	      break;
	  }
	}
