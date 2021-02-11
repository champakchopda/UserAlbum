<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Redirect;
use Auth;
use Hash;
use Yajra\DataTables\DataTables;

use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
         
        $this->user= new User;
    }


    public function index()
    {
        

         return view('Admin.user.listuser');
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

      public function Listuser(Request $request){

            $data = User::where('user_role_id',2)->get();
           

         return $data = Datatables::of($data)->make();
       
        



     $draw = $request->get('draw');
     $start = $request->get("start");
     $rowperpage = $request->get("length"); 
     $columnIndex_arr = $request->get('order');
     $columnName_arr = $request->get('columns');
     $order_arr = $request->get('order');
     $search_arr = $request->get('search');
     $columnIndex = $columnIndex_arr[0]['column']; 
     $columnName = $columnName_arr[$columnIndex]['data']; 
     $columnSortOrder = $order_arr[0]['dir'];
     $searchValue = $search_arr['value']; 
     

      $totalRecords = User::select('count(*) as allcount')->count();
     $totalRecordswithFilter = User::select('count(*) as allcount')->where('firstname', 'like', '%' .$searchValue . '%')->count();
     
     $records = DB::table('users')->where('user_role_id', '=', 2)

       ->where('lastname', 'like', '%' .$searchValue . '%')
       ->orWhere('email', 'like', '%' .$searchValue . '%')
       ->orWhere('phone_number', 'like', '%' .$searchValue . '%')
       ->orWhere('email', 'like', '%' .$searchValue . '%')
       ->orderBy($columnName,$columnSortOrder)
       ->skip($start)
       ->take($rowperpage)
       ->get();

        $data_arr = array();
   
     foreach($data as $record){


        $id = $record->id;
        $Firstname = $record->firstname;
        $Lastname = $record->lastname;
        $email = $record->email;
        $phone = $record->phone_number;
        $dob = $record->dob;

        if($record->status == 1)
            {
                $status = 'Active';
            }
            else
            {
                $status = 'In-Active';
            }
            if(!empty($record->profile_image))
        {
             $file_path = public_path().'/images/'.$record->profile_image;
             if(file_exists($file_path)){
              $logo = url('/public/images').'/'.$record->profile_image;
             }else{
                $logo = url('/public/avatar/avatar.png');
             }
        }else{
            $logo = url('/public/avatar/avatar.png');
        }

        $logo = '<img src="'.$logo.'" height="70px; width="70px;" >';
       
        $logo = $logo;
       
        $data_arr[] = array(
          "id" => $id,
          "firstname" => $Firstname,
          "lastname" => $Lastname,
          "email" => $email,
          "phone_number" => $phone,
          "status" => $status,
          "dob" => $dob,
          "profile_image" =>$logo,
         
        );
     }

     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "data" => $data_arr
     );
     return  json_encode($response);
     


}



        public function Userprofile(){

            
            $user = User::find(Auth::user()->id);
            
        if($user)
        {
                    return view('Admin.user.userprofile',compact('user'));

        }
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        
        if($user)
        {
                    return view('Admin.user.Edituser',compact('user'));

        }
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
         $data = $request->all();
         $validatedData = Validator::make($request->all(),[
        'fname' => 'required|max:255',
        'lname' => 'required|max:255',
       
        'phone' => 'numeric|digits_between:9,11',
        'password'=>'required|same:password_confirmation',
        'password_confirmation'=>'required',
        'profile_image'=>'max:1024kb|Mimes:jpeg,jpg,gif,png,pneg',
       
        ],[
        "fname.required" => 'Firstname is required',
        "lname.required" => 'Lastname is required',
        
       

        ])->validate(); 
         $user = User::find($id);
         if(Auth::user()->user_role_id == 2){

            $data['status'] = $user->status;

               $user = User::where('id',Auth::user()->id)->first();
             $check = Hash::check($data['oldpassword'],$user->password);

            
             if($check == true){

                $upd_data = ['password'=>Hash::make($data['password'])];

              $upassword =  User::where('id',$user->id)->update($upd_data);
              

             }
             else{
               $request->session()->flash('message', 'Sorry, your old password does not match!.');
               return redirect()->back();
             }
      

         }
      


         
         $name=$user->profile_image;
         $password= Hash::make($data['password']);
           if ($request->hasFile('profile_image')) {
            $file_path = public_path().'/images/'.$user->profile_image;
            if(!is_null($user->profile_image))
                        {
                             if(file_exists($file_path))
                            {
                            $image_path = public_path().'/images/'.$user->profile_image;
                            unlink($image_path);
                            }

                        }

        $image = $request->file('profile_image');
        $name = $image->getClientOriginalName();
        $destinationPath = public_path('images/');
        $image->move($destinationPath, $name);
    }


        
        $udata=['firstname'=>$data['fname'],'lastname'=>$data['lname'],'phone_number'=>$data['phone_number'],'profile_image'=>$name,'status'=>$data['status'],'dob'=>$data['dob'],'password'=>$password];
      $data =  $this->user->where('id', $id)->update($udata);

      if($data){
        if(Auth::user()->user_role_id == 1){
        $request->session()->flash('message', 'User Update successfully.');
        return redirect()->route('userlisting');
      }else{

        $request->session()->flash('message', 'Your Profile has been Update successfully');
               return redirect()->back();

      }
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user = User::find($id);
          if(isset($user) && !empty($user->profile_image)){
             $file_path = public_path().'/images/'.$user->profile_image;
            if(!is_null($user->profile_image))
                        {
                             if(file_exists($file_path))
                            {
                            $image_path =public_path().'/images/'.$user->profile_image;
                            unlink($image_path);
                            }

                        }

          }
         

         $delete = User::destroy($id);
    }
}
