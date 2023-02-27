<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Services;
use Carbon\Carbon;

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
        $upload_location = 'image/services/';

        $fullpath = $upload_location.$img_name;
        


        // $service = new Services;
        // $service->service_name = $request->service_name;
        // $service->service_image = $img_name;
        // $service->save();
        ;
        Services::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$fullpath,
            'created_at'=>Carbon::now(),
            
        ]);

        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('success','save service data');
    }

    public function update(Request $request,$id){
        
        $request->validate([
            'service_name'=>'max:255',
        ],
        [
            'service_name.max'=>'do not insert more than 255 string',
            
        ]);
        
        $service_image = $request->file('service_image');

        if($service_image){
            
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $upload_location = 'image/services/';
            $fullpath = $upload_location.$img_name;

            $service = Services::find($id)->update([
                'service_name'=>$request->service_name,
                'service_image'=>$fullpath,
            ]);
            $old_image = $request->old_image;
            unlink($old_image);
            $service_image->move($upload_location,$img_name);
            return redirect()->back()->with('success','update service data');

        }else{
            
            $service = Services::find($id)->update([
            'service_name'=>$request->service_name
            ]);
            return redirect()->back()->with('success','update service data');
        }

    }
    public function edit($id){

        
        
        $service = Services::find($id);
        

        // update only name
        //  update only name and  pic
        
        
        return view('admin.service.edit',compact('service'));

    }

    public function softdelete($id){

        $delete_image = Services::find($id)->service_image;
        unlink($delete_image);


        $delete = Services::find($id)->delete();
        return redirect()->back()->with('success','delete service data');
    }
}
