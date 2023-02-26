<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Hello : Department
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">Edit Form</div>
                            <div class="card-body">
                                <form action="{{url('/department/update/'.$departments->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="department_name">Department Name</label>
                                        <input type="text" class="form-control" name="department_name" 
                                        value="{{$departments->department_name}}">
                                    </div>
                                    @error('department_name')
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
