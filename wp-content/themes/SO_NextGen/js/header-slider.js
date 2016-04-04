$(document).ready(function() {
	//Initial placement of images
	var numberOfImages = $("#header-slider div img").length,
		counter = 0,
		totalWidth = 0,
		currentImage,
		currentImageId,
		currentImageWidth,
		firstImageId,
		firstImage,
		firstImageWidth,
		slideAmount;
	while (counter < numberOfImages) {
		counter++;
		currentImageId = "galleryImage" + counter;
		currentImage = document.getElementById(currentImageId);
		currentImageWidth = Number( $(currentImage).attr("width") );
		totalWidth = totalWidth + currentImageWidth;
	}
	//End initial placement

	//Image slider
	counter = 1;

	window.setInterval(runSlider, 5000);

	function runSlider() {
		firstImageId = "galleryImage" + counter;
		firstImage = document.getElementById(firstImageId);
		slideAmount = firstImage.clientWidth;
	//Code below adapted from: http://jsfiddle.net/jtbowden/ykbgT/2/
		$("#header-slider div").animate({
			left: '-=' + slideAmount
		}, 500, function() {
			$(firstImage).parent().css('left', totalWidth-slideAmount);
			$(firstImage).parent().appendTo('#header-slider');
		});
		counter++;
		if (counter > numberOfImages) { counter = 1; }
	}
	//End Image slider
});