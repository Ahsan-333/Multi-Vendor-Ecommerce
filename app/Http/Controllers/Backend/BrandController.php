<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BrandDataTable;
use App\Traits\imageUploadTrait;
use App\Models\Brand;
use Str;

class BrandController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|not_in:empty',
            'name' => 'required|max:200|unique:brands,name',
            'is_featured' => 'required',
            'status' => 'required'
        ]);

        $imagePath = $this->uploadImage($request, 'logo', 'uploads');
        $brand = new Brand();

        $brand->logo = $imagePath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr()->success('Created successfully.');
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => 'required|not_in:empty',
            'name' => 'required|max:200|unique:brands,name',
            'is_featured' => 'required',
            'status' => 'required'
        ]);

        $brand = Brand::findOrFail($id);
        $imagePath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);

        $brand->logo = empty(!$imagePath) ? $imagePath : $brand->logo;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr()->success('Updated successfully.');
        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->logo);
        $brand->delete();
        return response(['status' => 'success', 'message' => 'Record has been deleted!']);
    }

    public function changeStatus(Request $request){
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();
        return response(['message' => 'Status has been updated!']);
    }

    public function changeIsFeatured(Request $request){
        $brand = Brand::findOrFail($request->id);
        $brand->is_featured = $request->is_featured == 'true' ? 1 : 0;
        $brand->save();
        return response(['message' => 'Is_featured has been updated!']);
    }

}
