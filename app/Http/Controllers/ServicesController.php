<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    public function index(){
            $services = Services::paginate(5);
           return view('admin.service.index',compact('services'));
       }


    public function add(Request $request){
        $request->validate([
            'service_name'=>'required|unique:services|max:255',
            'service_image'=>'required|mimes:jpg,jpeg,png',
        ],
        [
            'service_name.required'=>'Please insert service name',
            'service_name.max'=>'do not insert more than 255 string',
            'service_name.unique'=>'service is exist',
            'service_image.required'=>'pleas upload image to service',
        ]);
        
        $service_image = $request->file('service_image');
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $service = new Services;
        $service->service_name = $request->service_name;
        $service->service_image = $img_name;
        $service->save();

        $upload_location = 'image/services/';

        $fullpath = $upload_location.$img_name;
        $service_image->move($upload_location,$img_name);
        // return redirect()->back()->with('success','save data okay');
    }
}
