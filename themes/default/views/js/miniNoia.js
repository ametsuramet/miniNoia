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
	var base = $('#base').val();
	prettyPrint();
	$('.show_search').toggleClick(function(){
		$('.search_wrapper').fadeIn();
	},function(){
		$('.search_wrapper').fadeOut();
	});
	$('.search_wrapper').keypress(function(e) {
		if(e.which == 13) {
			location.href = base + '?search=' + $(this).val();
		}
	});
	$('.post img').animate({ 
            width: "25%"           
        });
	$('.post img').toggleClick(function(){
		$(this).animate({
            width: "100%"           
        });
	},function(){
		$(this).animate({
            width: "25%"           
        });
	});
	 $('#summernote').summernote({
		  height: 300,                 // set editor height
		
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
			codemirror: { // codemirror options
			theme: 'monokai'
		  },  
		  oninit : function(){
		    $('pre').each(function(){
				var code = $(this).html()
				//alert($('<div/>').text(code).html() )
				 $(this).html($('<div/>').text(code).html())    
			 });  
		  },  
		  //focus: true,   
		  onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
               
            }
                         // set focus to editable area after initializing summernote
		});
		 
		 
		 $('#summernote-mini').summernote({
		  height: 300,                 // set editor height
		
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		oninit : function(){
		$("html, body").animate({ scrollTop: 450 }, "slow");
		},
		 // focus: true,   
		 toolbar: [
		    //[groupname, [button list]]
		     
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']],
		  ]     // set focus to editable area after initializing summernote
		});
		
		function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                 // console.log(url)
                }
            });
        }
        $('.fa-trash-o').click(function(){
        	var con = confirm('Are you sure?');
        	if(!con) return false
        })
});

function predefined() {

}