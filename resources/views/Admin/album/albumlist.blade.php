<!DOCTYPE html>
<html>
   <head>
      <title>All Album list</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="{{asset('public/Admin/js/like.js')}}"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <style type="text/css">
         .post{border: 1px solid #ccc;background-color:#fff;padding: 10px; text-align: justify; margin: 10px; border-radius: 10px; box-shadow: 5px 10px #888888;}
         .top h2{text-decoration: underline; font-weight:900;}
         .action{margin-top: 25px;}
         .Allalbumlist img{border-radius: 15px; padding: 15px;border: 1px solid #ccc;margin: 10px;}
         .Allalbumlist h4{text-transform: uppercase; text-decoration: underline; font-size: 30px; color: #8403fc; font-weight: 800;}
       /**/

      </style>
      <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body>
   	<div class="container-fluid"><h4 class="text-center"><a href="{{route('dashboard')}}">Go To Dashboard</a></h4></div>
      <div class="container">
         <div class="col-md-12 top">
            <div class="col-md-4">


               <h2  class="text-center">Login As: {{Auth::user()->firstname}}</h2>
            </div>
            <div class="col-md-4">
               <h2 class="text-center text-success">All Album Listing</h2>
            </div>
            <div class="col-md-4">
               <h2 class="text-center">	<a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
               Logout
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
               </form>
               </h2>
            </div>

            <div class="col-md-4">
               <form method="get">
                     <label>Search here</label>
                     <input type="text" name="search" id="searchalbum" class="form-control" placeholder="Search Here....">

               </form>
            </div>
                        <div class="col-md-4">
               <form id="datebysearch">
                  @include('Admin.message')
               
                     <label>Date By Search</label>
                     <input type="date"  name="searchbydate" id="searchbydate"  class="form-control" placeholder="Search By Date">
                        <br>
                     <input type="submit" name="submit"  class="btn btn-primary">

               </form>
            </div>

            <div class="result"></div>
            <br>

            <div class="Allalbumlist"> 
            @if(isset($album) && !is_null($album))
            @foreach($album as $key=>$value)
            <div class="col-md-12 col-sm-6 Allpost" id="Allalbum">
               <div class="post" id="delete_album_{{$value->id}}">
                  <h4 class="text-primary">{{$value->name}}</h4>
                  @php 
                   $albumimg = explode(',', $value->album_image)
                  @endphp
            
                            @if(!empty($albumimg))
                              @foreach($albumimg as $key => $imgalbum)
                                <img src="{{ asset('public/album/'.$imgalbum) }}" height="100" width="120" class="gallery-image-box">
                              @endforeach
                            @endif
                     <div class="action">
                  <span onclick="like_update('{{$value->id}}','{{Auth::user()->id}}')"  class="glyphicon glyphicon-thumbs-up btn-success btn likes ">Like <span id="like_count_{{$value->id}}">{{$value->like}}</span></span>

                  @if(Auth::user()->id == $value->user_id)
                  <span onclick="album_delete('{{$value->id}}','{{Auth::user()->id}}')" class="glyphicon  btn btn-danger">Delete</span>	
                  @endif		

                  </div>		
               </div>
            </div>
            @endforeach
            
            @endif

            <div class="norecord alert alert-primary">
               
               
            </div>

         </div>

      </div>
   </div>
   <div class="loader"></div>
   </body>
</html>