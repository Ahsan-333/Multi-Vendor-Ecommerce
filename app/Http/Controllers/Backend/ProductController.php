<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Product;
use Str;
use Auth;
use App\Traits\imageUploadTrait;

class ProductController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumb_img' => 'required|image|max:3000',
            'name' => 'required|max:200',
            'category' => 'required',
            'brand' => 'required',
            // 'sku' => 'required',
            'price' => 'required',
            // 'offer_price' => 'required',
            'stock_quantity' => 'required',
            // 'video_link' => '',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'seo_title' => 'max:200|nullable',
            'seo_description' => 'nullable|max:250',
            // 'product_type' => 'required',

            'status' => 'required',
        ]);

        $product = new Product();
        $imagePath = $this->uploadImage($request, 'thumb_img', 'uploads');
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thumb_image = $imagePath;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->stock_quantity;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_ed_date;
        $product->video_link = $request->video_link;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->product_type = $request->product_type;

        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();
        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSubCategories(Request $request){
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subCategories;
    }
    public function getChildCategories(Request $request){
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $childCategories;
    }

    public function changeStatus(Request $request){
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();
        return response(['message' => 'Status has been updated!']);
    }

}
