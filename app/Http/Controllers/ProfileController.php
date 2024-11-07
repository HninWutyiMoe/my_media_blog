<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        // dd($id);
        $userInfo = User::select('id', 'name', 'email', 'phone', 'address', 'gender', 'role')->where('id', $id)->first();
        // dd($userInfo->toArray());
        return view('admin.profile.profile', compact('userInfo'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->toArray());
        $data = $this->getData($request);
        $this->validationCheck($request);

        User::where('id', $request->userId)->update($data);
        return back()->with(['alertSuccess' => 'You update your account successfully.']);
    }
    // Change Profile
    public function changeProfile(){
        return view('admin.profile.image');
    }
    public function profileUpdate(Request $request){

        $data = ['image' => $request->profile];
        $this->imageValidate($request);

        if ($request->hasFile('profile')) {
            $currentUser = User::where('id', $request->userId)->first();
            $dbImage = $currentUser->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $newPhotoName = uniqid() . $request->file('profile')->getClientOriginalName();

            $request->file('profile')->storeAs('public', $newPhotoName);
            $data['image'] = $newPhotoName;
        }
        User::where('id', $request->userId)->update($data);
        return redirect()->route('dashboard')->with(['alertSuccess' => 'You changed your photo successfully.']);
    }

    // Change Password
    public function changePass(){
        return view('admin.profile.changePass');
    }
    // updatePassword
    public function updatePass(Request $request){
        // dd($request->toArray());
        $validator = $this->validatePassword($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // if(strlen($request->newPassword) != 8 && strlen($request->confirmPassword) != 8){
        //     return back()->with.....
        // }

        $currentUserId = Auth::user()->id;

        $currentUserPassword = User::where ('id',$currentUserId)->first();

        $dbPass = $currentUserPassword->password;

        // old pw from input , pw in db (if equal)
        if (Hash::check($request->oldPassword , $dbPass)) {
            $newData = ['password' => Hash::make($request->newPassword)];
            User::where('id' , $currentUserId)->update($newData);
            return redirect()->route('dashboard')->with(['changeSuccess' => 'Password changed success...']);
        }
        // else
        return back()->with(['notMatch' => 'The old password not match.Try Again!']);
    }

    // Password Validation
    private function validatePassword($request){
        $validator = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:16',
            'confirmPassword' => 'required|min:6|max:16|same:newPassword'
        ];
        $errorMessage = [
            'confirmPassword.same' => 'New Password & Confirm Password must be same'
        ];
        return Validator::make($request->all(),$validator,$errorMessage);
    }

    // Get user data Profile update
    private function getData($request)
    {
        return [
            // 'db' : update side data
            'name' => $request->userName,
            'email' => $request->userEmail,
            'phone' => $request->userPhone,

            'address' => $request->userAddress,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }

    //Validate User Profile Data
    private function validationCheck($request)
    // {
    //     return Validator::make($request->all(), [
    //         'userName' => 'required|max:255',
    //         'userEmail' => 'required',
    //         'userPhone' => 'min:11|max:15',
    //         'image' => 'image|mimes:png,jpg,jpeg,svg,gif,webp|file|max:2048',
    //     ], [
    //         'userName.required' => 'The Name Field is required!',
    //     ]);
    // }
    {
       Validator::make($request->all() , [
            'userName' => 'required|max:255',
            'userEmail' => 'required',
            'userPhone' => 'max:15',
        ],[
            'userName.required'=>'The Name Field is required!'
        ])->validate();
    }

    private function imageValidate($request){
        Validator::make($request->all() , [
        'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|file|max:2048',
        ])->validate();
    }
}
