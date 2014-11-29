$.fn.toggleClick = function(){

    var functions = arguments ;

    return this.click(function(){
            var iteration = $(this).data('iteration') || 0;
            functions[iteration].apply(this, arguments);
            iteration = (iteration + 1) % functions.length ;
            $(this).data('iteration', iteration);
    });
};
$(function() {
var base = $('#base').val()
		$('.search_btn').toggleClick(function(){
			$('#search_input').animate({
			    width: 150,
			    padding:"10px"			    
			  }, 1000, function() {
			    // Animation complete.
			  });
		},function(){
			$('#search_input').animate({
			    width: 0,
			    padding:0			    
			  }, 300, function() {
			    // Animation complete.
			  });
		});
		
		$("#zoom_01").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});
		$(".zoom_02").elevateZoom({tint:true, tintColour:'#FF0', tintOpacity:0.5, zoomWindowPosition:1});
		$('#flash_notice').click(function(){
			$(this).slideUp()
		})
		
		$( "#search_input" ).autocomplete({
	      source: base +'/'+"search_ajax",
	      minLength: 2,
	      select: function( event, ui ) {
	      	var link = base +'/'+ui.item.value
	      	console.log(link)
	      	location.href= link
	      }
	    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
		
		  return $( "<li>" )
			.append( '<span style="position:absolute;top:0;right:5px;font-size:0.6em;color:#ccc">'+item.cat+'</span><div>'+item.img+ item.label +'<br><small>'+item.isi+'</small><br></div><span class="harga">'+item.harga+'</span>' )
			.appendTo( ul );
		};
});