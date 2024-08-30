<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Auth;
use App\Traits\imageUploadTrait;
// use App\DataTables\AdminVendorProfileDataTable;
// AdminVendorProfileDataTable $dataTable

class AdminVendorProfileController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return $dataTable->render('admin.vendor-profile.index');
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.vendor-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => 'nullable|image|max:3000',
            'phone' => 'required|max:50',
            'email' => 'required|email|max:200',
            'address' => 'required|',
            'description' => 'required|',
            'fb_link' => 'nullable|url',
            'x_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        $imagePath = $this->updateImage($request, 'banner', 'uploads', $vendor->banner);
        $vendor->banner = empty(!$imagePath) ? $imagePath : $vendor->banner;
        $vendor->phone = $request->phone;
        $vendor->address = $request->address;
        $vendor->email = $request->email;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->x_link = $request->x_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->save();

        toastr('Record Successfully Updated', 'success');
        return redirect()->back();


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
}
