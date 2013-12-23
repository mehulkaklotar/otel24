var currentPhoto = 0;

var secondPhoto = 1;



var currentOpacity = new Array();

var imageArray = new Array("http://www.websoftrus.com/BEN_TV/image/allistar.jpg",

"http://www.websoftrus.com/BEN_TV/image/allistar2.jpg",

"http://www.websoftrus.com/BEN_TV/image/allistar3.jpg",
"http://www.websoftrus.com/BEN_TV/image/allistar4.jpg",
"http://www.websoftrus.com/BEN_TV/image/allistar5.jpg");



var FADE_STEP = 2;

var FADE_INTERVAL = 10;

var pause = false;



function init() {

	currentOpacity[0]=99;

	for(i=1;i<imageArray.length;i++)currentOpacity[i]=0;

	mHTML="";

	for(i=0;i<imageArray.length;i++)mHTML+="<div id=\"photo\" name=\"photo\" class=\"mPhoto\"><img src=\"" + imageArray[i]  +"\"></div>";

	document.getElementById("mContainer").innerHTML = mHTML;



	if(document.all) {

		document.getElementsByName("photo")[currentPhoto].style.filter="alpha(opacity=100)";

	} else {

		document.getElementsByName("photo")[currentPhoto].style.MozOpacity = .99;

	}



	mInterval = setInterval("crossFade()",FADE_INTERVAL);

}



function crossFade() {

	if(pause)return;



	currentOpacity[currentPhoto]-=FADE_STEP;

	currentOpacity[secondPhoto] += FADE_STEP;



	if(document.all) {

		document.getElementsByName("photo")[currentPhoto].style.filter = "alpha(opacity=" + currentOpacity[currentPhoto] + ")";

		document.getElementsByName("photo")[secondPhoto].style.filter = "alpha(opacity=" + currentOpacity[secondPhoto] + ")";

	} else {

		document.getElementsByName("photo")[currentPhoto].style.MozOpacity = currentOpacity[currentPhoto]/100;

		document.getElementsByName("photo")[secondPhoto].style.MozOpacity =currentOpacity[secondPhoto]/100;

	}



	if(currentOpacity[secondPhoto]/100>=.98) {

		currentPhoto = secondPhoto;

		secondPhoto++;

		if(secondPhoto == imageArray.length)secondPhoto=0;

		pause = true;

		xInterval = setTimeout("pause=false",2000);

	}

}



function doPause()  {

	if(pause) {

		pause = false;

		document.getElementById("pauseBtn").value = "pause";

	} else {

		pause = true;

		document.getElementById("pauseBtn").value = "play";

	}

}