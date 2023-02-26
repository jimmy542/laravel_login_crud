<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Hello : {{Auth::user()->name}}
             <p class="float-end">Total users {{ count($users) }} </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=0)
                        @foreach($users as $row)
                        @php($i++)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->created_at->diffforHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>
    </div>
</x-app-layout>
