<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Hello : Department
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                    @if(session('success'))

                        <div class="alert alert-success">{{session('success')}}</div>

                    @endif
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Department Table</div>
                                <div class="container">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">User id</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Created</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($departments as $row)
                                                
                                                <tr>
                                                    <th scope="row">{{$departments->firstItem()+$loop->index}}</th>
                                                    <td>{{$row->user->name}}</td>
                                                    <td>{{$row->department_name}}</td>
                                                    @if($row->created_at==null)
                                                        <td>no created at</td>
                                                    @else
                                                        <td>{{Carbon\Carbon::parse($row->created_at)->diffforHumans()}}</td>
                                                    @endif
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/department/edit/'.$row->id)}}">Edit</a>
                                                        </x-jet-button>
                                                    </td>
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/department/softdelete/'.$row->id)}}">Delete</a>
                                                        </x-jet-button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$departments->links()}}
                                    </div>
                                </div>
                                @if(count($trashed)>0)
                                <div class="card-header">Delete Record</div>
                                <div class="container">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">User id</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Created</th>
                                                <th scope="col">Restore</th>
                                                <th scope="col">Delete Permanent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($trashed as $row)
                                                <tr>
                                                    <th scope="row">{{$trashed->firstItem()+$loop->index}}</th>
                                                    <td>{{$row->user->name}}</td>
                                                    <td>{{$row->department_name}}</td>
                                                    @if($row->created_at==null)
                                                        <td>no created at</td>
                                                    @else
                                                        <td>{{Carbon\Carbon::parse($row->created_at)->diffforHumans()}}</td>
                                                    @endif
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/department/restore/'.$row->id)}}">Restore</a>
                                                        </x-jet-button>
                                                    </td>
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/department/harddelete/'.$row->id)}}">Delete</a>
                                                        </x-jet-button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$trashed->links()}}
                                    </div>
                                </div>
                                @endif
                                
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Form</div>
                            <div class="card-body">
                                <form action="{{route('addDepartment')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="department_name">Department Name</label>
                                        <input type="text" class="form-control" name="department_name">
                                    </div>
                                    @error('department_name')
                                    <span class="text-danger my-2">{{$message}}</span>
                                    @enderror()
                                    <br>
                                    <x-jet-button class="ml-4" type="submit" value="save">
                                        Save
                                    </x-jet-button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
