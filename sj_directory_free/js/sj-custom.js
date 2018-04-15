jQuery(window).load(function() {
	jQuery(".loader-content").fadeOut("slow");
});

jQuery(window).load(function() {
	var lastScrollTop = 0;
	jQuery(window).scroll(function(event) {
		var scrTop = jQuery(this).scrollTop();
		if( scrTop > lastScrollTop ) {
			if(jQuery('#yt_menu').hasClass('menu-fixed')) {
				jQuery('.menu-fixed').addClass('hidden-menu');
			}
		} else {
			if(jQuery('#yt_menu').hasClass('menu-fixed')) {
				jQuery('.menu-fixed').removeClass('hidden-menu');
			}
		}
		lastScrollTop = scrTop;
	});
});

jQuery(window).load(function() {
	jQuery(".loader-mod-box").fadeOut("slow");

	jQuery('.el-map .map-canvas').css('pointer-events', 'none');

	jQuery('.el-map').on('click', function () {
		jQuery('.el-map .map-canvas').css("pointer-events", "auto");
	});

	jQuery(".el-map").on('mouseleave', function() {
		jQuery('.el-map .map-canvas').css("pointer-events", "none"); 
	});
});
// Add Class In Slideshow
function customPager($classAll) {	
	jQuery(".owl-item.active .slider-detail .detail-top").addClass("detail-top-active");
	jQuery(".owl-item.active .slider-detail .detail-title").addClass("detail-title-active");
	jQuery(".owl-item.active .slider-detail .detail-bottom").addClass("detail-bottom-active");
	jQuery(".owl-item.active .slider-detail .detail-button").addClass("detail-button-active");
}


jQuery(window).load(function()  { 

	jQuery("#owl-carousel-detail").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		pagination : false,
		paginationNumbers: false,
		nav: true,
		loop: true,
		margin: 20,
		responsive:{
			
			1200:{
				items: 3,
			},
			992:{
				items: 2,
			},
			768:{
				items: 2,
			},
			480:{
				items: 2,
			},
			320:{
				items: 1,
			},
		}
	});

});

