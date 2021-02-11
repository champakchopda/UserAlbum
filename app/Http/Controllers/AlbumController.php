<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Redirect;
use Auth;
use Hash;
use App\User;
use App\Like;
use App\Album;
use Image;
use View;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response


     */
    public function __construct()
    {

        $this->album = new Album;
        $this->like = new Like;
    }

    public function index()
    {
        return view('Admin.album.album');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validatedData = Validator::make($request->all(),[
        'name' => 'required|max:255',
        'album_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
        "title.required" => 'Title is required',
        "body.required" => 'Body is required',
        ])->validate(); 
        $count = $request->file('album_image');
        $totalimg =  count($count);

        if($totalimg > 5){
             $request->session()->flash('message', 'You have Maximum 5 Image Upload.');
          return redirect()->route('createalbum');
        }
         if ($request->hasFile('album_image')) {
            $files = $request->file('album_image');
        foreach($files as $file){
            $name=$file->getClientOriginalName();
            $path = public_path('/album/');
            $file->move($path,$name);
            $images[]=$name;
        }
        $album =  Album::insert([
        'name' =>$input['name'],   
        'album_image'=>  implode(",",$images),
        'user_id'=>Auth::user()->id,
        'album_date'=>$input['album_date'],
    
    ]);

         if($album)
      {
           $request->session()->flash('message', 'Album Added  successfully.');
           return redirect()->route('createalbum');
      }


    }
    }

    public function LoadData(Request $request){

        $offset = $request->page;
        $limit = 5;
        $album = Album::skip($offset)->take($limit)->get();
        return view('Admin.album.loaddataalbum',['album'=>$album])->render();

    }

    public function Albumlist(Request $request){

        $album = Album::paginate(5);
        return view('Admin.album.albumlist',compact('album'));

    }

    public function Likeupdate(Request $request){

        $data=$request->all();
        $album = Album::find($data['id']);
        $likes = $this->like->checkLike($data['id'],Auth::user()->id);

if(is_null($likes))
{
        
        $this->like->create(['user_id'=>$data['user_id'],'album_id'=>$data['id']]);
        $udata = ['like'=>$album->like + 1];
        $upddata = Album::where('id',$data['id'])->update($udata);
        $post = Album::find($data['id']);
        return Response()->json(['status'=>200, 'data'=>$post]);
}
        return Response()->json(['status'=>400]);
}


public function Deletealbum(Request $request){
$data = $request->all();
    if(Auth::user()->id == $data['user_id']){
        $delete = Album::destroy($data['id']);
        if($delete)
        {
            return Response()->json(['status'=>200, 'data'=>$data]);
        }
        return Response()->json(['status'=>400]);
    }
return Response()->json(['status'=>400]); 
}
public function Albumsearch(Request $request)
{
    $data = $request->all();
    if($data['search'] == '')
    {
        $album = Album::all();
        return view('Admin.album.livesearchalbum',['album'=>$album])->render();
    }
    else
    {
        $album = Album::Where('name', 'like', '%' . $data['search'] . '%')->get();
        return view('Admin.album.livesearchalbum',['album'=>$album])->render();
    }

}


public function SearchbyDate(Request $request){


    $data = $request->all();
        $validatedData = Validator::make($request->all(),[
        'searchbydate' => 'required',
        ],[
        "searchbydate.required" => 'Please Select Date',
        ])->validate(); 
        $album = Album::where('album_date',$data['searchbydate'])->get();

        return view('Admin.album.livesearchalbum',['album'=>$album])->render();


      
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
