<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Service
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
                            <div class="card-header">Service Table</div>
                                <div class="container">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Service Name</th>
                                                <th scope="col">Service Image<th>
                                                <th scope="col"> Created </th>
                                                <th scope="col"> Edit </th>
                                                <th scope="col"> Delete </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($services as $row)
                                                <tr>
                                                    <th scope="row">{{$services->firstItem()+$loop->index}}</th>
                                                    <td>{{$row->service_name}}</td>
                                                    <td>
                                                        <img src="{{asset($row->service_image)}}" atl="" hight="100px" width="100px"/>
                                                    </td>
                                                    <td>
                                                    @if($row->created_at==null)
                                                        no created at
                                                    @else
                                                       <td> {{Carbon\Carbon::parse($row->created_at)->diffforHumans()}} </td>
                                                    @endif
                                                    </td>
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/service/edit/'.$row->id)}}">Edit</a>
                                                        </x-jet-button>
                                                    </td>
                                                    <td >
                                                        <x-jet-button class="ml-4">
                                                            <a href="{{url('/service/softdelete/'.$row->id)}}">Delete</a>
                                                        </x-jet-button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$services->links()}}
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Form</div>
                            <div class="card-body">
                                <form action="{{route('addService')}}" method="post" enctype=multipart/form-data>
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control" name="service_name">
                                    </div>
                                    @error('service_name')
                                    <span class="text-danger my-2">{{$message}}</span>
                                    @enderror()
                                    <br>
                                    <div class="form-group">
                                        <label for="service_image">Service Image</label>
                                        <input type="file" class="form-control" name="service_image">
                                    </div>
                                    @error('service_name')
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
