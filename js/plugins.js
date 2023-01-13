/*global console */
var img = document.querySelector("img"),
	btn = document.querySelector("button");
console.log(img.src);
img.onclick = function () {
	'use strict';
	if(img.src === "http://localhost/dj/images/girl6.jpg"){
		img.src = "http://localhost/DJ/images/girl3.jpg";

	} else {
img.src = "http://localhost/DJ/images/girl2.jpg"
	}
};