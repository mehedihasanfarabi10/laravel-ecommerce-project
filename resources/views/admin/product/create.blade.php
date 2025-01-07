@extends('admin.layout.app')

<style>
    .st {
        font-size: 18px !important;
        color: rgb(255, 255, 255) !important;
    }

    /* Ensure the page content takes full height */
    .page-content {
        min-height: calc(100vh - 100px);
        /* Adjust the content area to fill available space */
        padding-bottom: 50px;
        /* Adjust the bottom padding as needed */
        width: 100%;
        background-color: #da2a2a;
        color: rgb(186, 28, 28) !important;
        /* Ensure it takes full width */
    }

    footer {
        margin-top: auto;
        /* Ensure footer stays at the bottom */
        position: relative;
    }

    /* Center the form and make it responsive */
    .form-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        flex-direction: column;
        padding: 20px;
    }

    /* Form Styling */
    .form-container form {
        width: 100%;
        max-width: 800px;
        /* Limit form width */
        margin: 0 auto;
        background-color: #db4566;
        color: black !important;
        /* Dark background for contrast */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container .form-control {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid white;
    }

    input {
        color: white !important;
    }

    .form-container .btn {
        width: 100%;
        /* Full-width button */
        padding: 12px;
        background-color: #28a745;
        /* Green color */
        border: none;
        color: white !important;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-container .btn:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    .form-container .btn-outline-primary {
        margin-right: 5px;
    }

    /* Ensure consistent spacing */
    .page-header h3 {
        color: crimson;
        margin-bottom: 20px;
        text-align: center;
    }

    .container-fluid {
        width: 100%;
    }

    /* Container Styling */
    .container {
        max-width: 600px;
        margin: auto;
        padding: 7px;
    }

    /* Section Headers */
    .size-selector h5,
    .color-selector h5 {
        margin-bottom: 10px;

    }

    /* Size Options */
    .sizes {
        display: flex;
        gap: 6px;
        background-color: #e9dede;
        color: black !important;
    }

    .size-option {
        border: 2px solid #ccc;
        background-color: #000000;
        color: black !important;
        padding: 7px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .size-option:hover,
    .size-option.active {
        {{--  background-color: #007bff;  --}} background-color: #007;
        color: black !important;

        border-color: #007bff;
    }

    /* Color Options */
    .colors {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .color-option {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #ccc;
        background-color: #ffffff;
        color: black !important;
        cursor: pointer;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .color-option:hover,
    .color-option.active {
        border-color: #007bff;
        transform: scale(1.1);
    }

    .form-check {
        margin-bottom: 10px;
    }

    .form-check-label {
        margin-left: 5px;
        color: #ffffff !important;
        /* Adjust color if needed */
    }

    .d-flex.flex-wrap {
        gap: 10px;
        /* Space between checkboxes */
    }
</style>

@section('content')
    <div class="d-flex flex-column" style="min-height: 100vh; width: 100%;">
        {{-- <div class="page-content">  --}}
        <div class="page-header">
            <h3 class="st">Add Product</h3>
        </div>



        <!-- STart -->



        <div class="container-fluid st">
            <div class="form-container">
                <form action="{{ url('upload_product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="productTitle" class="form-label st">Title</label>
                        <input type="text" class="form-control" id="productTitle" name="title"
                            placeholder="Enter product title" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="productDescription" class="form-label st">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4"
                            placeholder="Enter product description" required></textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="productImage" class="st form-label">Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" accept="image/*"
                            required>
                    </div>

                    <!-- Image upload for multiple images -->
                    <div class="form-group">
                        <label for="gallery_images" class="st form-label">Upload more Product Images</label>
                        <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*"
                            class="form-control" multiple>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="productPrice" class="st form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price"
                            placeholder="Enter product price" step="0.01" required>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="productCategory" class="st form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category" required>
                            <option value="" disabled selected>Select category</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Sizes -->
                    <div class="mb-3">
                        <label class="st form-label">Sizes : </label>
                        <div class="d-flex flex-wrap">
                            @foreach ($size as $s)
                                <div class="form-check me-3">
                                    <input type="checkbox" class="text-primary form-check-input"
                                        id="size_{{ $s->id }}" name="sizes[]" value="{{ $s->size }}">
                                    <label for="size_{{ $s->id }}"
                                        class="form-check-label">{{ $s->size }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{--  New Color  --}}

                    <div class="mb-3">
                        <label class="st form-label"> Colors : </label>
                        <div class="d-flex flex-wrap">
                            @foreach ($color as $c)
                                <div class="form-check me-3" style="size: 20px">
                                    <input type="checkbox" class="form-check-input" id="color_{{ $c->id }}"
                                        name="colors[]" value="{{ $c->color }}">
                                    <label for="color_{{ $c->id }}"
                                        class="form-check-label">{{ $c->color }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>




                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="productQuantity" class="st form-label">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity"
                            placeholder="Enter product quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="is_latest">Latest Product:</label>
                        <input type="checkbox" name="is_latest"
                            {{ isset($product) && $product->is_latest ? 'checked' : '' }}>

                    </div>
                    <div class="mb-3">
                        <label for="is_featured">Featured Product:</label>
                        <input type="checkbox" name="is_featured"
                            {{ isset($product) && $product->is_featured ? 'checked' : '' }}>

                    </div>
                    <div class="mb-3">
                        <label for="is_hot_deal">Hot Deal:</label>
                        <input type="checkbox" name="is_hot_deal" style="color: white;"
                            {{ isset($product) && $product->is_hot_deal ? 'checked' : '' }}>

                    </div>


                    {{--  <label for="collection">Collection:</label>
                    <input type="text" name="collection" value="{{ $product->collection }}">  --}}


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Submit</button>


                    <!-- Colors -->










                </form>
            </div>
        </div>







        <!--End  -->
        {{-- </div>  --}}
    </div>
@endsection
