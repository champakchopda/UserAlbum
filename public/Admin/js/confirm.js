
$( document ).ready(function() {

$('body').on('click', '.permission', function() {
    if (confirm('Are you sure Want To Delete?'))
    {
 
            var id = $(this).attr('id');
 
            $.ajax({
            	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
                 method: "get",
                 url: "delete/"+id,
                success: function()
                {
                   $('#userlist').DataTable().ajax.reload();
                }
            });   
    }


    
});


	
});
