$(document).ready(function(){
    $('#carouselHacked').carousel();
    $('#carousel-testimonials').carousel();
	
	$('[data-toggle="tooltip"]').tooltip();   
	
	$('#bullets a[href^="#"]').click(function(){
	link = $(this).attr('href')
	scrollToTopById(link)
	return false
	});
	/*
	$('#carousel').carouFredSel({
			items               :3,
			height               :300,
            scroll : {
            items           : 1,
            duration        : 1000,                         
            pauseOnHover    : true
			},
			});*/
	$('#product .panel').hover(function(){
		$(this).find('.panel-footer').slideDown()
	},function(){
		$(this).find('.panel-footer').slideUp()
	});
});

function scrollToTopById(id) {
   $('html, body').animate({scrollTop: $(id).offset().top}, 1000);
}