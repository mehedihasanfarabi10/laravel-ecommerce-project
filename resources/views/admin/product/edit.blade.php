@extends('admin.layout.app')

<body>
    <style>
        /* General Page Styling */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h3 {
            color: crimson;
            font-weight: bold;
        }

        /* Form container styling */
        .form-container {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .form-container label {
            font-weight: bold;
            color: #333;
        }

        .form-container select,
        .form-container input[type='text'],
        .form-container input[type='number'],
        .form-container textarea,
        .form-container input[type='file'] {
            width: 100%;
            padding: 10px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-container .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .form-container .btn:hover {
            background-color: #0056b3;
        }

        .form-container .btn-success {
            background-color: #28a745;
        }

        .form-container .btn-success:hover {
            background-color: #218838;
        }

        .form-container .multi-field {
            margin-bottom: 15px;
        }

        /* Checkbox and radio styles */
        .form-check {
            margin: 10px 0;
        }

        .form-check-label {
            margin-left: 5px;
            color: #555;
            font-weight: normal;
        }

        /* Multi-select group styles */
        .multi-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .multi-option {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: background 0.3s;
        }

        .multi-option:hover,
        .multi-option.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Table style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }

        table td {
            background-color: #f8f9fa;
            color: #555;
            padding: 10px;
            text-align: center;
        }

        table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Style for the image preview */
        .image-preview {
            margin-top: 10px;
        }

        .image-preview img {
            max-width: 100px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }


        .delete-icon {
            background: rgba(247, 4, 4, 0.8);
            color: white !important;
            border-radius: 50%;
            padding: 2px 5px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
        }

        .delete-icon:hover {
            background: rgba(0, 255, 110, 0.8);
            color: white !important;
        }
    </style>
</body>

@section('content')
    {{-- Body  --}}

    {{--  <div class="page-content">  --}}
    <div class="page-header">
        <h3 style="color:crimson" class="div_design">Edit Product</h3>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid st">
        {{--  1st  --}}
        <div class="form-container" style="width: 70%;">
            <form action="{{ url('update_product', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="productTitle" class="form-label st">Title</label>
                    <input type="text" class="form-control" id="productTitle" name="title"
                        value="{{ old('title', $product->title) }}" placeholder="Enter product title" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="productDescription" class="form-label st">Description</label>
                    <textarea class="form-control" id="productDescription" name="description" rows="4"
                        placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="productImage" class="st form-label">Image</label>
                    <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                    <!-- Show current image -->
                    @if ($product->image)
                        <div class="image-preview">
                            <img src="/products/{{ $product->image }}" alt="Product Image" height="100" width="100">
                        </div>
                    @endif
                </div>

                <!-- Gallery Images -->
                <div class="mb-3">
                    <label class="st form-label">Upload New Gallery Images</label>
                    <input type="file" class="form-control" id="galleryImages" name="gallery_images[]" multiple
                        accept="image/*">
                    <label class="st form-label">Gallery Images</label>
                    <div class="image-gallery">
                        @if ($product->gallery_images && is_array($product->gallery_images))
                            @foreach ($product->gallery_images as $index => $galleryImage)
                                <div class="image-preview" style="display: inline-block; margin: 10px; position: relative;">
                                    <img src="/products/new/{{ $galleryImage }}" alt="Gallery Image" height="100"
                                        width="100">
                                    <!-- Delete Icon -->
                                    <span class="delete-icon" data-image-name="{{ $galleryImage }}"
                                        style="position: absolute; top: 5px; right: 5px; cursor: pointer; color: red; font-size: 18px;">
                                        &times;
                                    </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>




                <!-- Price -->
                <div class="mt-4 mb-3"
                    style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">
                    <label for="productPrice" class="st form-label">Price</label>
                    <input type="number" class="form-control" id="productPrice" name="price"
                        value="{{ old('price', $product->price) }}" placeholder="Enter product price" step="0.01"
                        required>


                    <!-- Quantity -->

                    <label for="productQuantity" class="st form-label">Quantity</label>
                    <input type="number" class="form-control" id="productQuantity" name="quantity"
                        value="{{ old('quantity', $product->quantity) }}" placeholder="Enter product quantity" required>
                </div>



                <!-- Category -->
                <div class="mt-4 mb-3"
                    style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">
                    <label for="productCategory" class="st form-label">Category</label>
                    <select class="form-select" id="productCategory" name="category_id" required>
                        <option value="" disabled>Select category</option>
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $product->categories->category_name == $cat->category_name ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>


                    <!-- Sub Category -->

                    <label for="productCategory" class="st form-label">Subcategory</label>
                    <select class="form-select" id="productCategory" name="subcategory_id" required>
                        <option value="" disabled>Select subcategory</option>
                        @foreach ($subcategory as $sub)
                            <option value="{{ $sub->id }}"
                                {{ $product->subcategory->subcategory_name == $sub->subcategory_name ? 'selected' : '' }}>
                                {{ $sub->subcategory_name }}

                            </option>
                        @endforeach
                    </select>


                    <!-- Child Category -->

                    <label for="productCategory" class="st form-label">Childcategory</label>
                    <select class="form-select" id="childcategory_id" name="childcategory_id" required>
                        <option value="" disabled>Select subcategory</option>
                        @foreach ($childcategories as $c)
                            <option value="{{ $c->id }}"
                                {{ $product->childcategory->childcategory_name == $c->childcategory_name ? 'selected' : '' }}>
                                {{ $c->childcategory_name }}

                            </option>
                        @endforeach
                    </select>

                    <!-- Brands -->

                    <label for="Brands" class="st form-label">Brands</label>
                    <select class="form-select" id="Brands" name="brand_id" required>
                        <option value="" disabled>Select Brands</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sizes -->
                <!-- Sizes -->
                <div class="mt-4 mb-3"
                    style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">
                    <label class="st form-label">Sizes : </label>
                    <div class="d-flex flex-wrap" style="border: 1px solid black;">
                        @foreach ($size as $s)
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input" id="size_{{ $s->id }}"
                                    name="size[]" value="{{ $s->id }}"
                                    {{ is_array($product->size) && in_array($s->id, $product->size) ? 'checked' : '' }}>
                                <label for="size_{{ $s->id }}"
                                    class="form-check-label">{{ $s->size }}</label>
                            </div>
                        @endforeach
                    </div>



                    <!-- Colors -->

                    <label class="st form-label">Colors : </label>
                    <div class="d-flex flex-wrap" style="border: 1px solid black;">
                        @foreach ($color as $c)
                            <div class="form-check mr-3">
                                <input type="checkbox" class="form-check-input" id="color_{{ $c->id }}"
                                    name="color[]" value="{{ $c->id }}"
                                    {{ is_array($product->color) && in_array($c->id, $product->color) ? 'checked' : '' }}>
                                <label for="color_{{ $c->id }}"
                                    class="form-check-label">{{ $c->color }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="mb-3">
                    <label for="is_latest">Latest Product:</label>
                    <input type="checkbox" name="is_latest" {{ $product->is_latest ? 'checked' : '' }}>



                </div>
                <div class="mb-3">
                    <label for="is_featured">Featured Product:</label>
                    <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }}>


                </div>
                <div class="mb-3">

                    <label for="is_hot_deal">Hot Deals:</label>
                    <input type="checkbox" name="is_hot_deal" {{ $product->is_hot_deal ? 'checked' : '' }}>

                </div>



                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>

        {{--  2nd  --}}
       
    </div>
    {{--  </div>  --}}

    {{-- Body End  --}}
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.delete-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const imageName = this.getAttribute('data-image-name');

                    if (confirm('Are you sure you want to delete this image?')) {
                        fetch(`/delete-gallery-image/${imageName}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // For CSRF protection
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.parentElement.remove(); // Remove the image preview
                                    alert('Image deleted successfully.');
                                } else {
                                    alert('Failed to delete image.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while deleting the image.');
                            });
                    }
                });
            });
        });
    </script>

    <script>
        // Fetch and update subcategories when category changes
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

                    // Clear child category dropdown
                    const childcategoryDropdown = document.getElementById('childategory_id');
                    childcategoryDropdown.innerHTML = '<option value="">Select Childcategory</option>';
                });
        });

        // Fetch and update child categories when subcategory changes
        document.getElementById('subcategory_id').addEventListener('change', function() {
            const subcategoryId = this.value;

            fetch(`/get-childcategories/${subcategoryId}`)
                .then(response => response.json())
                .then(data => {
                    const childcategoryDropdown = document.getElementById('childategory_id');
                    childcategoryDropdown.innerHTML = '<option value="">Select Childcategory</option>';

                    data.childcategories.forEach(childcategory => {
                        childcategoryDropdown.innerHTML += `
                            <option value="${childcategory.id}">${childcategory.childcategory_name}</option>
                        `;
                    });
                });
        });
    </script>
@endsection
