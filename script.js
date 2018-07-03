
function urlify(text) {
   var urlRegex = /(https?:\/\/[^\s]+)/g;
   return text.replace(urlRegex, CheckForImage); // to CheckForImage mas episterfei to apotelesma tis CheckForImage(url)
}
	
var CheckForImage = function CheckForImage(url) { //stin var CheckForImage vazoume function

	if ( ( url.indexOf(".jpg") > 0 ) || ( url.indexOf(".png") > 0 ) || ( url.indexOf(".gif") > 0 ) ) {
          return '<img src="' + url + '">' + '<br/>'
	} else {
          return '<a href="' + url + '">' + url + '</a>' + '<br/>'
      	}	
}
	
	
function ChangeToLink() {
	var text = document.getElementsByTagName("P"); //mazepse ola ta <p>
	var html;
	for (var i=0;i<text.length;i++){ 	 //gia kathe <p>
		html = urlify(text[i].innerHTML); //pare to text tou <p> kai xwsto stin urlify kai oti epistrepsei valto sto stin html
		text[i].innerHTML=html;				 //allakse ton kwdika HTML tis <p> me to perixomeno tis var html	
	}
}

