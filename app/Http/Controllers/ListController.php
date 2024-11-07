<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        $user = User::get();
        return view('admin.list.index',compact('user'));
    }

    // deleteAdmin
    public function deleteAdmin($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Delete Success...']);
    }

    // Search
    public function search(Request $request){
        // dd($request->all());
        $user = User::orWhere('name' , 'like' , '%' . $request->search . '%')
                    ->orWhere('email' , 'like' , '%' . $request->search . '%')
                    ->get();
        return view('admin.list.index',compact('user'));
    }
}
