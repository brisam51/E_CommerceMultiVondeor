<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;



class AdminController extends Controller
{
    //
    function dashboard()
    {
        return view('admin.dashboard');
    }


    function login(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();

            $rules=[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessage=[
                'email.requierd'=>'Email is Required',
                'email.email'=>'Emial must be email format',
                'password.required' => 'Password  Required'
            ];
            $this->validate($request,$rules,$customMessage);
            
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1]))
            {
                return redirect('admin/dashboard');
            }
            else{
                return redirect()->back()->with('error_message','Invalid Email or password');
            }
        }
        return view('admin.login');
    }

    //create logout method..
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

public function updateAdminPassword(Request $request){
    if($request->isMethod('post')){
        $data=$request->all();
       
        
    //check if password intred by admin is correct
    if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
        //check if intred password is match  with confirm intred password
        if($data['confirm_password']==$data['new_password']){
            Admin::where('id',Auth::guard('admin')->user()->id)
            ->update(['password'=>bcrypt($data['new_password'])]);
            return redirect()->back()->with('sucess_message','password has been updated succesfully');

        }else{
            return redirect()->back()->with('error_message','your password insert is not correct');
        }

    }else{
        return redirect()->back()->with('error_message','new password  and  confirm password not match');
    }
    }

   
    $adminDetails=Admin::where('email',Auth::guard('admin')->user()->email)
    ->first()->toArray();
    return view('admin.settings.update-admin-password')->with(compact('adminDetails'));

}

//check admin password/b
public function checkAdminPassword(Request $request){
$data=$request->all();
//echo "<pre>"; print_r($data); die;
if(Hash::check($data['current_password'] ,Auth::guard('admin')->user()->password)){
    return "true";
}else{
    return "false";
}

}


//Update Admin details
function updateAdminDetails(Request $request){
    if($request->isMethod('post')){
        $data=$request->all();
       // echo "<pre>"; print_r($data); die;
      $rules=[
          'admin_name'=>'required|regex:/^[\pL\s\-]+$/u',
        'admin_mobile' => 'required|digits_between:11,11'
      ];
      $customeMessage=[
          'admin_name.required'=>'admin name is required',
          'admin_name.regex'=>'admin name must be only A-Z',
          'admin_mobile.required'=>'admin mobile required',
          'admin_mobile.digits_between'=>'admin bile must be digts 11 number',
      ];
      $this->validate($request,$rules,$customeMessage);
      //upload image
      if($request->hasFile('admin_image')){
          $image_tmp=$request->file('admin_image');
          if($image_tmp->isValid()){
               //Get image extension
              $extension=$image_tmp->getClientOriginalExtension();
              //Generate new Name for image
              $imageName=rand(111,9999).'.'.$extension;
              //generate image photos
              $imagePath='admin/images/photos/'.$imageName;
              Image::make($image_tmp)->save($imagePath);
          }

        }
        //check  if user dosnot change an image
        elseif(!empty($data['current_admin_image'])){
              $imageName=$data['current_image'];
          }else{
              $imageName="";
          }

              
       
        //update name and mobile
        Admin::where('id',Auth::guard('admin')->user()->id)->update(
            [
                'name'=>$data['admin_name'],
                  'mobile'=>$data['admin_mobile'],
                  'image'=>$imageName
            ]
        );

        return redirect()->back()->with('sucess_message','name and mobile updated sucessfully');
        
    }
    return view('admin.settings.update-admin-details');
}


}//End Class...
