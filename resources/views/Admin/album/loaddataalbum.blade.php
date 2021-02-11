 @if(isset($album) && !is_null($album))
            @foreach($album as $key=>$value)
            <div class="col-md-12 col-sm-6 Allpost">
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
            @else

            <div class="alert alert-danger">Data Not Found</div>
            @endif