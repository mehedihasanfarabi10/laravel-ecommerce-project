@extends('admin.layout.app')

<style>
    /* Styling for the container holding Edit Subcategory and Search */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    /* Form container for Edit Subcategory */
    .edit-subcategory-form {
        width: 60%;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Styling for input fields */
    .edit-subcategory-form select,
    .edit-subcategory-form input[type='text'],
    .edit-subcategory-form input[type='submit'] {
        width: 100%;
        margin: 10px 0;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .edit-subcategory-form input[type='submit'] {
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .edit-subcategory-form input[type='submit']:hover {
        background: #0056b3;
    }

    /* Search container */
    .search-container {
        width: 35%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .search-container input[type='search'] {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .search-container input[type='submit'] {
        background: #28a745;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .search-container input[type='submit']:hover {
        background: #218838;
    }
</style>
@section('content')
    <div class="container-fluid">
        <!-- Header Section -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="header-section">
            <!-- Edit Subcategory Form -->
            <div class="edit-subcategory-form">
                <form action="{{ route('childcategory.update', $childcategory->id) }}" method="post">
                    @csrf
                    <div>
                        <label>Select Category:</label>
                        <select name="category_id" required>
                            <option value="">Not Selected --</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" @if ($childcategory->category_id === $cat->id) selected @endif>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <label>Select Subcategory :</label>
                        <select name="subcategory_id" required>
                            <option value="">Not Selected --</option>
                            @foreach ($subcategory as $sub)
                                <option value="{{ $sub->id }}" @if ($childcategory->subcategory_id === $sub->id) selected @endif>
                                    {{ $sub->subcategory_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Update Childcategory Name:</label>
                        <input type="text" name="childcategory_new_name" value="{{ $childcategory->childcategory_name }}"
                            required>
                    </div>
                    <input type="submit" value="Update Childcategory">
                </form>
            </div>

            <!-- Search Form -->
            <div class="search-container">
                <form action="{{ url('category_search') }}" method="get">
                    @csrf
                    <input type="search" name="search" placeholder="Search categories">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;

            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    const subcategoryDropdown = document.getElementById('subcategory_id');
                    subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';

                    data.subcategories.forEach(subcategory => {
                        subcategoryDropdown.innerHTML += `
                        <option value="${subcategory.id}">${subcategory.subcategory_name}</option>
                    `;
                    });
                });
        });
    </script>
@endsection
