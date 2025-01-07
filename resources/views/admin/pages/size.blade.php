@extends('admin.layout.app')

@section('title', 'Size Management')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3 style="color:crimson" class="div_design">Add Size</h3>
        </div>

        <div class="div_design">
            <form action="{{ route('add_size') }}" method="post">
                @csrf
                <input type="text" name="size" required placeholder="Enter size name">
                <input type="submit" class="btn btn-primary" value="Add Size">
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Size Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sss as $s)
                    <tr>
                        @if ($s)
                        <td>{{ $s->size ?? 'N/A' }}</td>
                        @else
                            <td>Invalid size</td>
                        @endif

                        <td>
                            <a class="btn btn-success" href="{{ url('size_update', $s->id) }}">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ url('delete_size', $s->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
