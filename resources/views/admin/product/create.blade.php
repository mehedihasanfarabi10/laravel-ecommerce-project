@extends('admin.layout.app')

<body>
    <style>
        /* General Page Styling */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h3 {
            color: rgb(24, 21, 22);
            font-weight: bold;
            background-color: white;
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
    </style>
</body>

@section('content')
    <div class="header">
        <h3>Add Product</h3>
    </div>

    <div class="form-container" style="width: 80%;">
        <form action="{{ url('upload_product') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Product Title -->
            <div>
                <label>Product Title:</label>
                <input type="text" name="title" placeholder="Enter product title" required>
            </div>

            <!-- Product Description -->
            <div>
                <label>Product Description:</label>
                <textarea name="description" rows="4" placeholder="Enter product description" required></textarea>
            </div>

            <!-- Product Image -->
            <div>
                <label>Upload Product Image:</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <!-- Additional Product Images -->
            <div>
                <label>Upload Additional Images:</label>
                <input type="file" name="gallery_images[]" accept="image/*" multiple>
            </div>

            <!-- Product Price -->
            <div
                class="mt-4 mb-3"
                style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">
                <label>Product Price:</label>
                <input type="number" name="price" placeholder="Enter product price" step="0.01" required>

                <!-- Product Quantity -->
                <label>Product Quantity:</label>
                <input type="number" name="quantity" placeholder="Enter quantity" required>

                {{--  Brand  --}}
                <label> Brands:</label>
                <select name="brand_id" id="brand_id" required>
                    <option value="">Select Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Category -->
            {{--  <!-- <div class="mb-3">
                        <label for="productCategory" class="st form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Select category</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div> -->  --}}

            <div
            class="mt-4 mb-3"
                style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">


                <label> Category:</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    @foreach ($category as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>


                <!-- Product Subcategory -->

                <label> Subcategory:</label>
                <select name="subcategory_id" id="subcategory_id" required>
                    <option value=""> Subcategory</option>
                    @foreach ($subcategory as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->subcategory_name }}</option>
                    @endforeach
                </select>

                <!-- Product Childcategory -->

                <label> Childcategory:</label>
                <select name="childcategory_id" id="childategory_id" required>
                    <option value="">Select Childcategory</option>
                    @foreach ($childcategories as $child)
                        <option value="{{ $child->id }}">{{ $child->childcategory_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sizes -->
            <div class="d-flex inline-block mt-3 mb-4" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 10px;">
                <label>Available Sizes:</label>
                <div class="multi-group" style="border: 1px solid #555;">
                    @foreach ($size as $s)
                        <div class="form-check">
                            <input type="checkbox" name="sizes[]" value="{{ $s->size }}" id="size_{{ $s->id }}">
                            <label for="size_{{ $s->id }}" class="form-check-label">{{ $s->size }}</label>
                        </div>
                    @endforeach
                </div>

                <hr/>
                <!-- Colors -->

                <label>Available Colors:</label>
                <div class="multi-group" style="border: 1px solid #555;">
                    @foreach ($color as $c)
                        <div class="form-check">
                            <input type="checkbox" name="colors[]" value="{{ $c->color }}"
                                id="color_{{ $c->id }}">
                            <label for="color_{{ $c->id }}" class="form-check-label">{{ $c->color }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Options -->
            <div class="multi-field">
                <label>
                    <input type="checkbox" name="is_latest"> Latest Product
                </label>
            </div>
            <div class="multi-field">
                <label>
                    <input type="checkbox" name="is_featured"> Featured Product
                </label>
            </div>
            <div class="multi-field">
                <label>
                    <input type="checkbox" name="is_hot_deal"> Hot Deal
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Add Product</button>
        </form>
    </div>
@endsection

@section('script')
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
