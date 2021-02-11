$( document ).ready(function() {
var page = $('.Allalbumlist .Allpost').length;
$(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            loadMoreData(page);
        }
    });



$("#searchalbum").on('keyup', function () {


var string = $('#searchalbum').val();

     $.ajax({
                type: "get",
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                url: 'albumsearch',
                data: "search=" + string,
                success: function (response) {

                    $('.container #Allalbum').html("");
                    $('.result').html(response);
                
                    
                }
            });
});


$('#datebysearch').submit(function (e) {

    e.preventDefault();
    var searchbydate = $('#searchbydate').val();
            $.ajax({
                type : 'post',
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                url: 'searchbydate',
                data: "searchbydate=" + searchbydate,
                success: function (response) {
                    $('.container #Allalbum').html("");
                    $('.result').html(response);
                    
                   


                    
                }
            });
        });

});

function like_update(id,user_id){
	            $.ajax({
                type: "post",
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                url: 'likealbum',
                data: "id=" + id  + "&user_id=" + user_id,
                success: function (response) {
                        console.log(response);
                        

                    if(response.status == 200)
                    {
                    var currentlike_count = $('#like_count_'+id).html();
                    $('#like_count_'+id).addClass('disabled');

                    $('#like_count_'+id).html(response.data.like);
                  

                }
                	
                }
            });	
	}

function album_delete(id, user_id){
                $.ajax({
                type: "post",
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                url: 'deletealbum',
                data: "id=" + id  + "&user_id=" + user_id,
                success: function (response) {
                    if(response.status == 200)
                    {
                    
                    $('#delete_album_'+id).remove();
                }
                    
                }
            }); 


    }

function loadMoreData(page){

        var page = $('.Allalbumlist .Allpost').length;
        
      $.ajax(
            {
                url: 'albumlistloaddata',
                type: "get",
                data: "page=" + page,
                beforeSend: function()
                {

                    
                }
            })
            .done(function(response)
            {
                if(response == ""){
                    $('.loader').hide();
                    $('.Allalbumlist .norecord').html("No Record Found");
                    return false; 
                }
                 $(".Allalbumlist").append(response);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
    }