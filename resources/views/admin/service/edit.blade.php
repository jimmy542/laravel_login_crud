<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Edit : Service 
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">Edit Form</div>
                            <div class="card-body">
                                <form action="{{url('/service/update/'.$service->id)}}" method="post" enctype=multipart/form-data>
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control" name="service_name" 
                                        value="{{$service->service_name}}">
                                    </div>
                                    @error('service_name')
                                    <span class="text-danger my-2">{{$message}}</span>
                                    @enderror()
                                    <br>
                                    <div class="form-group">
                                        <label for="service_image">Service Image</label>
                                        <input type="file" class="form-control" name="service_image">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input name="old_image" type="hidden" value="{{$service->service_image}}"/>
                                        <img src="{{asset($service->service_image)}}" atl="" width="200px" height="200px"/>
                                    </div>
                                    @error('service_image')
                                    <span class="text-danger my-2">{{$message}}</span>
                                    @enderror()
                                    <br>
                                    <x-jet-button class="ml-4" type="submit" value="save">
                                        Update
                                    </x-jet-button>
                                </form>
                            </div>
                        </div>                        
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
