<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change Password Page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        //password changing state
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)

            ];
            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return back()->with(['changeSuccess' => 'Password changed succesfully...']);
        }

        return back()->with(['notMatch' => 'The old password is not match. Try Again!']);
    }

    //direct admin details page
    public function details(){
        return view('admin.account.details');
    }

    //direct admin profile edit page
    public function edit(){
        return view('admin.account.edit');
    }

    //update account

    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // 1. old image name | 2. check => delete | 3. store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            //Image delete
             if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName); //Public mhr thein tar
            $data['image'] = $fileName; //database mhr thein

        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated....']);

    }

    //admin list

    public function list(){
        $admin = User::where('role','admin')
        ->where(function($q) {
            $q->orWhere('name','like','%' .request('key').'%')
                              ->orWhere('email','like','%'.request('key').'%')
                              ->orWhere('gender','like','%'.request('key').'%')
                              ->orWhere('phone','like','%'.request('key').'%')
                              ->orWhere('address','like','%'.request('key').'%');
        })


                        ->paginate(3);
        //return response()->json($admin);
        $admin->appends(request()->all());

        return view('admin.account.list',compact('admin'));
    }

    //admin delete

    public function delete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted']);
    }

    //admin change role

    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data for change role
    private function requestUserData($request){
        return [
            'role' => $request->role,
        ];
    }

    //request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now() //Carbon import lote
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:4|max:10',
            'newPassword' => 'required|min:4|max:10',
            'confirmPassword' => 'required|min:4|max:10|same:newPassword'
        ])->validate();
    }
}
