<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vondare;
use App\Models\VendorBisnssDatails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\business_section\Bank_Details;
use App\Models\VendorBankDatails;

class AdminController extends Controller
{
    //
    function dashboard()
    {
        return view('admin.dashboard');
    }


    function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessage = [
                'email.requierd' => 'Email is Required',
                'email.email' => 'Emial must be email format',
                'password.required' => 'Password  Required'
            ];
            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or password');
            }
        }
        return view('admin.login');
    }

    //create logout method..
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();


            //check if password intred by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //check if intred password is match  with confirm intred password
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)
                        ->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('sucess_message', 'password has been updated succesfully');
                } else {
                    return redirect()->back()->with('error_message', 'your password insert is not correct');
                }
            } else {
                return redirect()->back()->with('error_message', 'new password  and  confirm password not match');
            }
        }


        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)
            ->first()->toArray();
        return view('admin.settings.update-admin-password')->with(compact('adminDetails'));
    }

    //check admin password/b
    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }


    //Update Admin details
    function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|digits_between:11,11'
            ];
            $customeMessage = [
                'admin_name.required' => 'admin name is required',
                'admin_name.regex' => 'admin name must be only A-Z',
                'admin_mobile.required' => 'admin mobile required',
                'admin_mobile.digits_between' => 'admin bile must be digts 11 number',
            ];
            $this->validate($request, $rules, $customeMessage);
            //upload image
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    //Get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate new Name for image
                    $imageName = rand(111, 9999) . '.' . $extension;
                    //generate image photos
                    $imagePath = 'admin/images/photos/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            //check  if user dosnot change an image
            elseif (!empty($data['current_admin_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }



            //update name and mobile
            Admin::where('id', Auth::guard('admin')->user()->id)->update(
                [
                    'name' => $data['admin_name'],
                    'mobile' => $data['admin_mobile'],
                    'image' => $imageName
                ]
            );

            return redirect()->back()->with('sucess_message', 'name and mobile updated sucessfully');
        }
        return view('admin.settings.update-admin-details');
    }




    //Update Vendor Details..!
    public function updateVendorDetails($slug, Request $request)
    {
        if ($slug == "personal") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                //  echo "<pre>";
                // print_r($data);
                //  die;

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'integer|digits_between:11,11',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pincode' => 'integer|digits_between:2,5',
                    'vendor_address' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u'

                ];
                $customeMessage = [
                    'vendor_name.required' => 'vendor name is required',
                    'vendor_name.regex' => 'Vendor name must be only A-Z',
                    'vendor_mobile.required' => 'Vendor mobile required',
                    'vendor_mobile.digits_between' => 'Vendor mobile must be digts 11 number',

                    'vendor_city.required' => 'vendor city is required',
                    'vendor_city.regex' => 'city name must only A=Z',
                    'vendor_country.required' => 'contry name is required',
                    'vendor_country.regex' => 'country name must be only A-z',
                    'vendor_pincode' => 'Vendor mobile must be digtst:1-10 number',
                    'vendor_address.regex' => 'address must only A=Z',
                    'vendor_address.required' => 'address is required',
                    'vendor_state.regex' => 'state must only A=Z',
                    'vendor_state.required' => 'state is required',

                ];
                $this->validate($request, $rules, $customeMessage);
                //upload image
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        //Get image extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate new Name for image
                        $imageName = rand(111, 9999) . '.' . $extension;
                        //generate image path
                        $imagePath = 'admin/images/photos/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }
                //check  if user dosnot change an image
                elseif (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }

                //update in Admin Table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(
                    [
                        'name' => $data['vendor_name'],
                        'mobile' => $data['vendor_mobile'],
                        'image' => $imageName
                    ]
                );

                //update in Vendor Table
                Vondare::where(
                    'id',
                    Auth::guard('admin')->user()->vondar_id
                )->first()->update(
                    [
                        'name' => $data['vendor_name'],
                        'mobile' => $data['vendor_mobile'],
                        'city' => $data['vendor_city'],
                        'country' => $data['vendor_country'],
                        'pincode' => $data['vendor_pincode'],
                        'address' => $data['vendor_address'],
                        'state' => $data['vendor_state'],
                        'image' => $imageName
                    ]
                );
                return redirect()->back()->with('sucess_message', 'vendor updated sucessfully');
            }
            $vendorDetails = Vondare::where(
                'id',
                Auth::guard('admin')->user()->vondar_id
            )->first()->toArray();
        } else if ($slug == "business") {
            $vendorDetails = VendorBisnssDatails::where(
                'vendor_id',
                Auth::guard('admin')->user()->vondar_id
            )->first()->toArray();
        } else if ($slug == "bank") {
        }
        return view("admin.settings.update_vendor_details")->with(compact('slug', 'vendorDetails'));
    }
    /////New Method I created
    public function slugtest($slug, Request $request)
    {
        if ($slug == "personal") {
            if ($request->isMethod('post')) {
                $data = $request->all();

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'integer|digits_between:11,11',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pincode' => 'integer|digits_between:2,5',
                    'vendor_address' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u'

                ];
                $customeMessage = [
                    'vendor_name.required' => 'vendor name is required',
                    'vendor_name.regex' => 'Vendor name must be only A-Z',
                    'vendor_mobile.required' => 'Vendor mobile required',
                    'vendor_mobile.digits_between' => 'Vendor mobile must be digts 11 number',
                    'vendor_city.required' => 'vendor city is required',
                    'vendor_city.regex' => 'city name must only A=Z',
                    'vendor_country.required' => 'contry name is required',
                    'vendor_country.regex' => 'country name must be only A-z',
                    'vendor_pincode' => 'Vendor mobile must be digtst:1-10 number',
                    'vendor_address.regex' => 'address must only A=Z',
                    'vendor_address.required' => 'address is required',
                    'vendor_state.regex' => 'state must only A=Z',
                    'vendor_state.required' => 'state is required',

                ];
                $this->validate($request, $rules, $customeMessage);
                //upload image
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        //Get image extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate new Name for image
                        $imageName = rand(111, 9999) . '.' . $extension;
                        //generate image path
                        $imagePath = 'admin/images/photos/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }
                //check  if user dose not change an image
                elseif (!empty($data['current_address_proof_image'])) {
                    $imageName = $data['current_address_proof_image'];
                } else {
                    $imageName = "";
                }

                //update in Admin Table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(
                    [
                        'name' => $data['vendor_name'],
                        'mobile' => $data['vendor_mobile'],
                        'image' => $imageName
                    ]
                );

                //update in Vendor Table
                Vondare::where(
                    'id',
                    Auth::guard('admin')->user()->vondar_id
                )->first()->update(
                    [
                        'name' => $data['vendor_name'],
                        'mobile' => $data['vendor_mobile'],
                        'city' => $data['vendor_city'],
                        'country' => $data['vendor_country'],
                        'pincode' => $data['vendor_pincode'],
                        'address' => $data['vendor_address'],
                        'state' => $data['vendor_state'],
                        'image' => $imageName
                    ]
                );
                return redirect()->back()->with('sucess_message', 'vendor updated sucessfully');
            }
            $vendorDetails = Vondare::where(
                'id',
                Auth::guard('admin')->user()->vondar_id
            )->first()->toArray();


            return view("admin.settings.slugtest")->with(compact('slug', 'vendorDetails'));
        }

        //Update Business Vendor Details...
        //By this section  we can Update business detailes 1401.03.26 shamsei


        elseif ($slug == "business") {
            $imageName = '';
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                //Upload Image..!
                if ($request->hasFile('address_proof_image')) {

                    //create variable for get image from request
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        //1-Generate image extension..!
                        $image_Extension = $image_tmp->getClientOriginalExtension();
                        //2-Generate new name for image..!
                        $imageName = rand(111, 9999) . '.' . $image_Extension;
                        //3-Generate image path..!
                        $image_path = 'admin/images/proof/' . $imageName;
                        //4-save image ..!
                        Image::make($image_tmp)->save($image_path);
                    }
                }

                //Create Validation Rulse
                $business_rules = [
                    'shop_name' => 'required',
                    'shop_address' => 'required',
                    'shop_city' => 'required',
                    'shop_state' => 'required',
                    'shop_country' => 'required',
                    'shop_pincode' => 'required',
                    'shop_mobile' => 'required',
                    'shop_website' => 'required',
                    'shop_email' => 'required',
                    'address_proof' => 'required',
                    //'address_proof_image' => 'required',
                    'business_license_number' => 'required',
                    'gst_namber' => 'required',
                    'pan_number' => 'required',

                ];

                //Create Custom Message for each fields
                $business_customMessage = [
                    'shop_name.required' => 'Shop Name is Required',
                    'shop_address.required' => 'Shop address is Required',
                    'shop_city .required' => 'Shop city is Required',
                    'shop_state.required' => 'Shop state is Required',
                    'shop_country.required' => 'Shop country is Required',
                    'shop_pincode.required' => 'Shop pincode is Required',
                    'shop_mobile.required' => 'Shop mobile is Required',
                    'shop_website.required' => 'Shop website is Required',
                    'shop_email.required' => 'Shop email is Required',
                    'address_proof.required' => 'Shop address proof is Required',
                    //'address_proof_image.required' => 'Shop address omage proof  is Required',
                    'business_license_number.required' => 'Shop busness license is Required',
                    'gst_namber.required' => 'Shop GST number is Required',
                    'pan_number.required' => 'Shop Pan number is Required',

                ];
                // Set Rules Custom Message and requst in action
                $this->validate($request, $business_rules, $business_customMessage);



                VendorBisnssDatails::where(
                    'vendor_id',
                    Auth::guard('admin')->user()->vondar_id
                )->first()->update([
                    'shop_name' => $data['shop_name'],
                    'shop_address' => $data['shop_address'],
                    'shop_city' => $data['shop_city'],
                    'shop_country' => $data['shop_country'],
                    'shop_state' => $data['shop_state'],
                    'shop_pincode' => $data['shop_pincode'],
                    'shop_mobile' => $data['shop_mobile'],
                    'shop_website' => $data['shop_website'],
                    'shop_email' => $data['shop_email'],
                    'address_proof' => $data['address_proof'],
                    'address_proof_image' => $imageName,
                    'business_license_number' => $data['business_license_number'],
                    'gst_namber' => $data['gst_namber'],
                    'pan_number' => $data['pan_number'],
                    //'address_proof'=>$data['address_broof']
                ]);
                return redirect()->back()->with('sucess_message', 'Business  Dateails updated Sucessfully');
            }
            $vendorBusinessDetails = VendorBisnssDatails::where(
                'vendor_id',
                Auth::guard('admin')->user()->vondar_id
            )->first()->toArray();
            $owner = Admin::where('id', Auth::guard('admin')->user()->id)->first()->toArray();

            return view("admin.settings.slugtest")->with(compact('slug', 'vendorBusinessDetails', 'owner'));
        } elseif ($slug == 'bank') {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'bank_name' => 'required',
                    'account_holder_name' => 'required',
                    'bank_ifsc_code' => 'required',
                    'bank_account_number' => 'required',
                ];

                $ErrorMessage = [
                    'bank_name.required' => ' Bank Name is required',
                    'account_holder_name.required' => 'Holder Name is Required',
                    'bank_ifsc_code.required' => 'IFSC Bank is requied',
                    'bank_account_number.reqired' => 'Account Bank Numder is Rquired'
                ];
                $this->validate($request, $rules, $ErrorMessage);
                VendorBankDatails::where('id', Auth::guard('admin')->user()->vondar_id)->first()->update([
                    'bank_name' => $data['bank_name'],
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_account_number' => $data['bank_account_number'],
                    'bank_ifsc_code' => $data['bank_ifsc_code'],

                ]);
                return redirect()->back()->with('sucess_message', 'Bank  Dateails updated Sucessfully');
            }
            $vendorBusinessDetails = VendorBisnssDatails::where(
                'vendor_id',
                Auth::guard('admin')->user()->vondar_id
            )->first()->toArray();
            $owner = Admin::where('id', Auth::guard('admin')->user()->id)->first()->toArray();
            $bankDetails = VendorBankDatails::where('id', Auth::guard('admin')->user()->vondar_id)->first()->toArray();

            return view("admin.settings.slugtest")->with(compact('slug', 'owner', 'vendorBusinessDetails', 'bankDetails'));
        }
    }


    //function for showing admins sub admins and vonders information page..!
    public  function admins($type =null)    {
        $admins=Admin::query();
        if(!empty($type)){
            $admins=$admins->where('type',$type);
            $title=ucfirst($type);
          
        }else{
            $title='All/subadmin/vendor';
        }
        $admins=$admins->get()->toArray();
      // dd($admins);
     // echo  "<per>";print_r($admins);die;
        return view('admin.admins.admins')->with(compact('admins','title'));
    }
}//End Class...
