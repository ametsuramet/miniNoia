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
	$(".del_thumb").each(function(){
		$(this).click(function(){
			var parent = $(this).parent()
			parent.find("img").attr("src",null)
			parent.find("input").val(null)
			
		});
	});
	del_menu();
	
	var add_menu = '<div class="row form-setting"><div class="col-md-2"></div>'
		add_menu +='<div class="col-md-4"><input class="form-control" name="menu[name][]" type="text" value=""></div>'
		add_menu +='<div class="col-md-4"><input class="form-control menu_link" name="menu[link][]" type="text" value=""></div>'
		add_menu +='<div class="col-md-2"><i class="fa fa-times  del_menu" style="cursor:pointer;font-size:1.2em;color:#f00"></i>	</div></div>'
	$('.add_menu').click(function(){
		$('.setting_menu').append(add_menu);
		del_menu(); 
	})
	
	$('.add_menu_child1').click(function(){
		var name = $(this).data('name');
		var add_menu_child1 = '<div class="row form-setting"><div class="col-md-2"></div>'
		add_menu_child1 +='<div class="col-md-4"><input class="form-control" name="menu_child1['+name+'][name][]" type="text" value=""></div>'
		add_menu_child1 +='<div class="col-md-4"><input class="form-control menu_link" name="menu_child1['+name+'][link][]" type="text" value=""></div>'
		add_menu_child1 +='<div class="col-md-2"><i class="fa fa-times  del_menu" style="cursor:pointer;font-size:1.2em;color:#f00"></i>	</div></div>'
	
		var row_menu_child1 = $(this).parent().parent().next()
		row_menu_child1.append(add_menu_child1);
		del_menu(); 
	})
	
	
	if($('[name="comment"]').is(':checked')){
		$('[name="comment"]').val('true');
	}else{
		$('[name="comment"]').val('false');
	}
	$('[name="comment"]').change(function(){
		if($('[name="comment"]').is(':checked')){
			$('[name="comment"]').val('true');
		}else{
			$('[name="comment"]').val('false');
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
	 $('#summernote,#summernote2').summernote({
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
function del_menu(){
		$('.del_menu').each(function(){
			$(this).click(function(){		
				$(this).parent().parent().remove()
			});
		});
		$( ".menu_link" ).autocomplete({
	      source: "menuPick",
	      minLength: 2,
	      select: function( event, ui ) {}
	    });
	}
function predefined() {

}