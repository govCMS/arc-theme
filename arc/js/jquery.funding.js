/*script by Ekhwan@osky*/
(function($) {
	Drupal.behaviors.augovCommon = {
		attach:function (context, settings) {
			var toggle = true;
			$(window).resize(function () {

		        $(document).ready(function () {
		        	// Set max height for Top Links
		            $('.upperLinks li').height("");
		            var heightArray = $('div.upperLinks li').map(function () {
		                return $(this).height();
		            }).get();
		            var maxHeight = Math.max.apply(Math, heightArray);
		            $('.upperLinks li').height(maxHeight);

		            // Set width for Top Links

		      		/*//set max height for lowerlink
		            var heightArray2 = $('div.lowerLinks > ul > li').map(function () {
		                return $(this).height();
		            }).get();
		            var maxHeight2 = Math.max.apply(Math, heightArray2);
		            $('div.lowerLinks > ul > li').height(maxHeight2);*/

		        });

	   		}).trigger('resize');

			// $(".upperLinks li:not(li:nth-child(2))").click(function(){
			$(".upperLinks li").click(function(){
			    var url = $(this).find('a:first').attr('href');
			    window.location = url;
			});

			$(".lowerLinks li:not(li:nth-child(2))").click(function(){
			    var url = $(this).find('a:first').attr('href');
			    window.location = url;
			});

    		$('.lowerLinks ul').css("display", "none");


   //  		$(".upperLinks li:nth-child(2)").click(function() {
   //  			if(toggle){
   //  				$('.lowerLinks ul').fadeIn( "slow", function() {
			// 		    // Animation complete
			// 		  });
   //  				$('.upperLinks li:not(li:nth-child(2))').toggleClass("disable");
   //  				toggle = false;
   //  			}
			//   	else{
			//   		$('.lowerLinks ul').fadeOut( "slow", function() {
			//   			// Animation complete
			// 		  });
			//   		$('.upperLinks li:not(li:nth-child(2))').toggleClass("disable");
			//   		toggle = true;
			//   	}
			// });

			$( ".upperLinks li" ).hover(
				function() {
					$(this).find('a:first').addClass( "linkHover" )
			  	}, function() {
   					$(this).find('a:first').removeClass( "linkHover" )
  				}
			);

			$( ".lowerLinks li" ).hover(
				function() {
					$(this).find('a:first').addClass( "linkHover" )
			  	}, function() {
   					$(this).find('a:first').removeClass( "linkHover" )
  				}
			);
    	}
	};

})(jQuery);