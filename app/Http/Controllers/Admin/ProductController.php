<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public function add_product()
    {

        $category = Category::all();

        $size = ProductSize::all();

        $color = ProductColor::all();

        $product = new Product;

        return view('admin.product.create', compact('category', 'size', 'color', 'product'));
    }

    public function upload_product(Request $request)
    {
        // Validate form data
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'price' => 'required|numeric',
        //     'category' => 'required|exists:categories,id',
        //     'quantity' => 'required|integer|min:1',
        // ]);

        // Handle the image upload
        // $imagePath = $request->file('image')->store('product_images', 'public');

        // Save product to database
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $product->image = $imagename;
        }

        $fileNameToStore = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $fileName = 'gallery_image_' . md5(uniqid()) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products/new'), $fileName);
                $fileNameToStore[] = $fileName;
            }
        }

        // if ($request->hasFile('gallery_images')) {
        //     foreach ($request->file('gallery_images') as $image) {
        //         $fileName = 'gallery_image_' . md5(uniqid()) . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('products/new'), $fileName);
        //         $fileNameToStore[] = $fileName;
        //     }
        //     $product->gallery_images = json_encode($fileNameToStore); // Save as JSON
        // }




        $product->gallery_images = $fileNameToStore;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        // Encode arrays to JSON for sizes and colors
        $product->size = json_encode($request->sizes ?? []);
        $product->color = json_encode($request->colors ?? []);
        $product->is_latest = $request->has('is_latest') ? true : false;
        $product->is_featured = $request->has('is_featured') ? true : false;
        $product->is_hot_deal = $request->has('is_hot_deal') ? true : false;

        // Save the product and ensure an ID is generated
        $product->save();

        // Check if product ID exists
        if (!$product->id) {
            toastr()->error('Product could not be created.');
            return redirect()->back();
        }

        // Get size IDs
        // $sizeIds = ProductSize::whereIn('size', $request->sizes)->pluck('id');

        // // Get color IDs
        // $colorIds = ProductColor::whereIn('color', $request->colors)->pluck('id');

        // // Attach sizes and colors to the product
        // $product->sizes()->attach($sizeIds);
        // $product->colors()->attach($colorIds);


        // Attach sizes to the product
        // $product->sizes()->attach($request->sizes);

        // Save sizes
        // if ($request->has('sizes')) {
        //     foreach ($request->sizes as $size) {
        //         ProductSize::create([

        //             'size' => $size,
        //         ]);
        //     }
        // }

        // Save colors
        // if ($request->has('colors')) {
        //     foreach ($request->colors as $color) {
        //         ProductColor::create([
        //             'product_id' => $product->id,
        //             'color' => $color,
        //         ]);
        //     }
        // }

        toastr()->timeOut(5000)->success('Product created successfully.');
        return redirect()->route('view.product');
    }

    public function view_product()
    {
        $productData = Product::paginate(10);
        // $productData = Product::all();

        return view('admin.product.index', compact('productData'));
    }
    public function delete_product($id)
    {
        Cart::where('product_id', $id)->delete();

        $productData = Product::find($id);

        // Delete image from local directory

        $imagepath = public_path('products/' . $productData->image);

        if (file_exists($imagepath)) {
            unlink($imagepath);
        }

        $productData->delete();

        toastr()->timeOut(10000)->closeButton()->success('Product deleted successful.');

        return redirect('/view_product');
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $size = ProductSize::all(); // Assuming you have a `Size` model
        $color = ProductColor::all(); // Assuming you have a `Color` model

        // If they are stored as JSON strings, decode them:
        $product->size = is_string($product->size) ? json_decode($product->size, true) : $product->size;
        $product->color = is_string($product->color) ? json_decode($product->color, true) : $product->color;

        return view('admin.product.edit', compact('product', 'category', 'size', 'color'));
    }
    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        // Ensure the values are encoded only if they are arrays
        // $product->size = is_array($request->size) ? json_encode($request->size) : $request->size;
        // $product->color = is_array($request->color) ? json_encode($request->color) : $request->color;

        // Save sizes and colors as names instead of IDs
        // $product->size = ProductSize::whereIn('id', $request->size)->pluck('size')->toArray();
        // $product->color = ProductColor::whereIn('id', $request->color)->pluck('color')->toArray();

        if (!empty($request->size)) {
            $product->size = ProductSize::whereIn('id', $request->size)->pluck('size')->toArray();
        } else {
            // If no size is selected, keep the current size
            $product->size = $product->size ?? []; // Retain current size or empty array if not set
        }

        // Check if colors are provided and save them, otherwise keep the existing colors
        if (!empty($request->color)) {
            $product->color = ProductColor::whereIn('id', $request->color)->pluck('color')->toArray();
        } else {
            // If no color is selected, keep the current color
            $product->color = $product->color ?? []; // Retain current color or empty array if not set
        }

        $product->is_latest = $request->has('is_latest') ? true : false;
        $product->is_featured = $request->has('is_featured') ? true : false;
        $product->is_hot_deal = $request->has('is_hot_deal') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $product->image = $imagename;
        }

        // Handle gallery images
        $fileNameToStore = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $fileName = 'gallery_image_' . md5(uniqid()) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products/new'), $fileName);
                $fileNameToStore[] = $fileName;
            }

            // Merge new images with existing ones
            $product->gallery_images = array_merge($product->gallery_images ?? [], $fileNameToStore);
        }

        // Remove selected images, if any
        if ($request->has('remove_images')) {
            $product->gallery_images = array_diff($product->gallery_images, $request->remove_images);
        }

        // Sync sizes and colors
        // if ($request->sizes) {
        //     $product->sizes()->sync($request->sizes); // Sync directly using IDs
        // } else {
        //     $product->sizes()->detach(); // Remove all if none selected
        // }

        // if ($request->colors) {
        //     $product->colors()->sync($request->colors); // Sync directly using IDs
        // } else {
        //     $product->colors()->detach(); // Remove all if none selected
        // }

        $product->save();

        toastr()->timeOut(10000)->closeButton()->success('Product updated successfully.');

        return redirect('/view_product');
    }


    public function product_search(Request $request)
    {


        $search = $request->search;
        // viewproduct e je variable use kora hoyece setai use korte hobe productData
        $productData = Product::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->paginate(3);

        return view('admin.product.index', compact('productData'));
    }



    public function category_search(Request $request)
    {


        $search = $request->search;
        // viewproduct e je variable use kora hoyece setai use korte hobe productData
        $data = Category::where('category_name', 'LIKE', '%' . $search . '%')->paginate(10);

        return view('admin.pages.category', compact('data'));
    }


    public function product_details($id)
    {

        // $product = Product::find($id);


        // $sizes = ProductSize::where('product_id', $id)->pluck('size');
        // $colors = ProductColor::where('product_id', $id)->pluck('color');
        // $sizes = ProductSize::get();
        // $colors = ProductColor::get();

        // if ($sizes->isEmpty() || $colors->isEmpty()) {
        //     return redirect()->back()->withErrors('No sizes or colors available for this product.');
        // }


        $product = Product::find($id);
        // Retrieve the product along with its sizes
        // $product = Product::with('sizes', 'colors')->find($id);
        // $sizes = $product->sizes;
        // $colors = $product->colors;

        // $sizes = ProductSize::where('product_id', $id)->get()->all();
        // $colors = ProductColor::where('product_id', $id)->get()->all();
        // dd($sizes, $colors);
        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        // Decode gallery_images
        // $product->gallery_images = is_string($product->gallery_images)
        //     ? json_decode($product->gallery_images, true)
        //     : $product->gallery_images;

        return view('home.pages.product_details', compact('product', 'count'));
    }

    public function deleteGalleryImage($imageName)
    {
        // Retrieve the product with the gallery image
        $product = Product::whereJsonContains('gallery_images', $imageName)->first();

        if ($product) {
            // Remove the image from the gallery_images array
            $galleryImages = $product->gallery_images;
            $key = array_search($imageName, $galleryImages);

            if ($key !== false) {
                unset($galleryImages[$key]);
                $product->gallery_images = array_values($galleryImages); // Re-index the array
                $product->save();

                // Delete the physical file
                $filePath = public_path('products/new/' . $imageName);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }

    public function storeReview(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review = new Review(); // Assuming you have a Review model
        $review->product_id = $id;
        $review->name = $validated['name'];
        $review->rating = $validated['rating'];
        $review->review = $validated['review'];
        $review->save();

        toastr()->success('Thank you for your review!');

        return redirect()->back();
    }
}
