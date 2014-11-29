$(function() {
	 $('#summernote').summernote({
		  height: 300,                 // set editor height
		
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		
		  focus: true,   
		  onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
               
            }
                         // set focus to editable area after initializing summernote
		});
		 $('#summernote-mini').summernote({
		  height: 300,                 // set editor height
		
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		
		  focus: true,   
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