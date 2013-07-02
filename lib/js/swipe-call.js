jQuery(document).ready(function($) {
	//slider lite
   $("#slider-lite").swiperight(function() {
      $("#slider-lite").carousel('prev');
    });
   $("#slider-lite").swipeleft(function() {
      $("#slider-lite").carousel('next');
   });
	 
	 //slider pro
	  $("#slider").swiperight(function() {
      $("#slider").carousel('prev');
    });
   $("#slider").swipeleft(function() {
      $("#slider").carousel('next');
   });
});