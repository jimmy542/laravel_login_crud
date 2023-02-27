<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    public function index(){

         $departments = Department::paginate(5);
         $trashed = Department::onlyTrashed()->paginate(3);
        // $departments = DB::table('departments')->get();
        // $departments = DB::table('departments')->paginate(3);
        // view <!-- <td>{{$row->user->name}}</td> -->

        // query builder
        // $departments = DB::table('departments')
        // ->join('users','departments.user_id','users.id')
        // ->select('departments.*','users.name')->paginate(5);
        // view <!-- <td>{{$row->name}}</td> -->
        
        return view('admin.department.index',compact('departments','trashed'));
    }

    public function store(Request $request){
        // dd($request->department_name);
        $request->validate([
            'department_name'=>'required|unique:departments|max:255'
        ],
        [
            'department_name.required'=>'Please insert department name',
            'department_name.max'=>'do not insert more than 255 string',
            'department_name.required'=>'department is exist',
        ]
    
        );
        // save to Eloquent
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();

        // save data table
        // $data = array();
        // $data['department_name'] = $request->department_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('departments')->insert($data);
        return redirect()->back()->with('success','save data okay');
    }

    public function edit($id){
        $departments = Department::find($id);
        return view('admin.department.edit',compact('departments'));

    }
    public function update(Request $request,$id){
        $request->validate([
            'department_name'=>'required|unique:departments|max:255'
        ],
        [
            'department_name.required'=>'Please insert department name',
            'department_name.max'=>'do not insert more than 255 string',
            'department_name.required'=>'department is exist',
        ]
    
        );
        $update=Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect()->route('department')->with('success','update data okay');
    }

    public function softdelete($id){

        // dd($id);
        //  debug

        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success','delete okay');
    }

    public function restore($id){
        $department = Department::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success','restore okay');
    }

    public function harddelete($id){

        $department = Department::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Delete okay');
    }
}
