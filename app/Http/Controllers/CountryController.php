<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index(){
        $country = Country::get();
        return view('admin.country.index' , compact('country'));
    }

    // Search
    public function countrySearch(Request $request){
        $country = Country::where('name','Like','%'. $request->search .'%')->get();
        return view('admin.country.index',compact('country'));
    }

    // Add Country
    public function adding(Request $request){
        // dd($request->all());
        $data = $this->requestData($request);
        $this->formValidation($request);
        // dd($data);
        Country::create($data);
        return back()->with(['createdSuccess' => 'Country created success...']);
    }

    // Edit
    public function edit($id){
        $country = Country::get();
        $updateCountry = Country::where('id',$id)->first();
        return view('admin.country.edit',compact('country','updateCountry'));
    }
    public function update(Request $request){
    //    dd($request->all());
        $data = $this->requestData($request);
        $this->formValidation($request);
        Country::where('id',$request->countryId)->update($data);
        return redirect()->route('admin#country')->with(['updateSuccess'=>'Country updated success...']);
    }
    // Delete
    public function delete($id){
        Country::where('id',$id)->delete();
        return redirect()->route('admin#country')->with(['deleteSuccess' => 'Country deleted success...']);
    }

    // Request
    private function requestData($request){
        return [
            'name' => $request->countryName ,
            'updated_at' => Carbon::now(),
        ];
    }

    // FormValidation

    private function formValidation($request){
        Validator::make($request->all() , [
            'countryName' => 'required|unique:countries,name,'.$request->countryId,
        ])->validate();
    }
}
