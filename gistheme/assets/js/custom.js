jQuery( document ).ready(function($) {
    $(".show-panel .arrow").click(function(){
        $(this).next().toggle();
        $(this).toggleClass( "active" );
    });

    $("li.bp-up").click(function(){
       $(".result-wrapper").addClass("intro");
    });
    $(".x-tool-close").click(function(){
       $(".result-wrapper").removeClass("intro");
    });

    $('#tabs li a').click(function(){

	    var t = $(this).attr('id');
        console.log(t);
	  if($(this).hasClass('inactive')){ //this is the start of our condition
	    $('#tabs li a').addClass('inactive');
	    $(this).removeClass('inactive');

	    $('.container').hide();
	    $('#'+ t + 'C').fadeIn('slow');
	 }
	});

   $('.thumbnail-ngaplut').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1
    });
   
});
