@extends('Admin.Default')
@section('content')
<div id="page-wrapper">
			<div class="main-page">
<div class="forms">
	
					<h2 class="title1"> Album</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4> Album</h4>
						</div>
						<div class="form-body">
							<form method="POST" action="{{route('save_album')}}" enctype="multipart/form-data" >
								 @csrf
								  @include('Admin.message')
							 
                        
							   <div class="form-group">
							    <label for="logo">name</label>
							     <input type="name"  class="form-control"  name="name"> 
							      </div>

							   <div class="form-group">
							    <label for="album_date">Album Date</label>
							     <input type="date"  class="form-control"  name="album_date"> 
							      </div>

							      <div class="form-group">
							    <label for="logo">Album Image</label>

							     <input type="file" id="album_image" name="album_image[]" multiple="">
							     
							   
							      </div>


							    <button type="submit" class="btn btn-default">Submit</button> </form> 
						</div>
					</div>
					
				</div>
				</div>
			</div>


					@endsection