@extends('admin.layout.app')

<body>
    <style>
        .st {
            font-size: 18px !important;
            color: white !important;
        }

        /* Ensure the page content takes full height */
        .page-content {
            min-height: calc(100vh - 100px);
            /* Adjust the content area to fill available space */
            padding-bottom: 50px;
            /* Adjust the bottom padding as needed */
            width: 100%;
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
            flex-direction: column;
            padding: 20px;
        }

        /* Form Styling */
        .form-container form {
            width: 100%;
            max-width: 800px;
            /* Limit form width */
            margin: 0 auto;
            background-color: #2d2d2d;
            /* Dark background for contrast */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container .form-control {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container .btn {
            width: 100%;
            /* Full-width button */
            padding: 12px;
            background-color: #28a745;
            /* Green color */
            border: none;
            color: white;
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

        .form-label {
            font-size: 16px;
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
            color: white!important;
            border-radius: 50%;
            padding: 2px 5px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
        }

        .delete-icon:hover {
            background: rgba(0, 255, 110, 0.8);
            color: white!important;
        }
    </style>
</body>

@section('content')
    {{-- Body  --}}

    <div class="page-content">
        <div class="page-header">
            <h3 style="color:crimson" class="div_design">Edit Product</h3>
        </div>

        <div class="container-fluid st">
            <div class="form-container">
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
                                <img src="/products/{{ $product->image }}" alt="Product Image" height="100"
                                    width="100">
                            </div>
                        @endif
                    </div>

                    <!-- Gallery Images -->
                    <div class="mb-3">
                        <label class="st form-label">Upload New Gallery Images</label>
                        <input type="file" class="form-control" id="galleryImages" name="gallery_images[]" multiple accept="image/*">
                        <label class="st form-label">Gallery Images</label>
                        <div class="image-gallery">
                            @if ($product->gallery_images && is_array($product->gallery_images))
                                @foreach ($product->gallery_images as $index => $galleryImage)
                                    <div class="image-preview"
                                        style="display: inline-block; margin: 10px; position: relative;">
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
                    <div class="mb-3">
                        <label for="productPrice" class="st form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price"
                            value="{{ old('price', $product->price) }}" placeholder="Enter product price" step="0.01"
                            required>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="productCategory" class="st form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category" required>
                            <option value="" disabled>Select category</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->category_name }}"
                                    {{ old('category', $product->category) == $cat->category_name ? 'selected' : '' }}>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sizes -->
                    <!-- Sizes -->
                    <div class="mb-3">
                        <label class="st form-label">Sizes</label>
                        <div class="d-flex flex-wrap">
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
                    </div>


                    <!-- Colors -->
                    <div class="mb-3">
                        <label class="st form-label">Colors</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($color as $c)
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input" id="color_{{ $c->id }}"
                                        name="color[]" value="{{ $c->id }}"
                                        {{ is_array($product->color) && in_array($c->id, $product->color) ? 'checked' : '' }}>
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
                            value="{{ old('quantity', $product->quantity) }}" placeholder="Enter product quantity"
                            required>
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
        </div>
    </div>

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
@endsection
