@extends('admin.layout.app')

@section('title', 'User Details')

  

@section('content')

    <style>
        .table tr:hover{
            background-color: white;
            color: black;
        }
    </style>

    {{--  Main Content  --}}

    <div class="d-flex align-items-stretch">

        {{--  Body  --}}

        <div class="d-flex align-items-stretch" style="width: 100%;">


            

           

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="background-color: white;color:black;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            
                            <td>{{ $user->address }}</td>
                           

                            <td>
                               
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure to delete user?')">Delete</button>
                                </form>
                            </td>

                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No sellers found.</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>



        </div>

        {{--  Body End  --}}
    </div>

    {{--  @include('admin.includes.footer')   --}}



    {{-- End  Main Content  --}}


@endsection
