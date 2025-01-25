@extends('admin.layout.app')

@section('title', 'Seller Details')

  

@section('content')

    {{--  Main Content  --}}

    <div class="d-flex align-items-stretch">

        {{--  Body  --}}

        <div class="d-flex align-items-stretch" style="width: 100%;">


            

           

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Seller Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Business</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sellers as $seller)
                        <tr style="background-color: white;color:black;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->phone }}</td>
                            <td>{{ $seller->business }}</td>
                            <td>{{ $seller->address }}</td>
                            <td>
                                @if($seller->is_active)
                                    <span class="badge bg-success" style="color: white!important;">Active</span>
                                @else
                                    <a class="badge btn-dark" style="color: white!important;">Inactive</a>
                                @endif
                            </td>

                             {{--  Seller Active/Inactive  --}}

                             <td>
                                <form action="{{ route('admin.sellers.toggle', $seller->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ $seller->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </td>

                            <td>
                               
                                <a href="{{route('admin.seller.edit', $seller->id) }}" class="btn btn-success btn-sm">Edit</a>
                                <form action="{{ route('admin.seller.delete', $seller->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
