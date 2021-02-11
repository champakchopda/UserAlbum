<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Redirect;
use Auth;
use Hash;
use App\User;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->user = new User;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Dashboard(){

        return view('Admin.Dashboard');
    }
    public function index()
    {
       
        
        return view('Register_form');
    }
 


    public function store(Request $request)
    {
        $data = $request->all();
        $validatedData = Validator::make($request->all(),[
        'email' => 'unique:users,email',
        'password' => 'required|string||same:password_confirmation|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'password_confirmation'=>'required',
        'profile_image'=>'max:1024kb|Mimes:jpeg,jpg,gif,png,pneg',
       
        ],[
        
        "email.email" => 'Email should be valid',
        ])->validate(); 
          $this->user->firstname= $data['fname'];
          $this->user->lastname = $data['lname'];
            $name=null;
        if ($request->hasFile('profile_image')) 
        {
            $image = $request->file('profile_image');
            $name = $image->getClientOriginalName();
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $thumbnail = public_path('userpic/101/').$filename.'_thumb'.'.'.$extension;
            $img = Image::make($image)->resize(100, 100)->save($thumbnail);
            $path = public_path('/userpic/101');
            $image->move($path, $name);
                 
        }  
        
         $this->user->email = $data['email'];
         $this->user->profile_image = $name;
         $this->user->password= Hash::make($data['password']);
       
      $data =  $this->user->save();
      if($data)
      {
           $request->session()->flash('message', 'User Registration successfully.');
           return redirect()->route('register_form');
      }

    }


    public function Login(Request $request){

         $input = $request->all();
        
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])) )
        {
                return redirect()->route('dashboard');
            
        }else{
            return Redirect::back()->withErrors(['Sorry Username And password Does Not match!']);
           

    }
}
}
