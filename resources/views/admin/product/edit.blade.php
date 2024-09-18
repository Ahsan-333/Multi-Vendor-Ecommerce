@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label>Preview</label>
                                    <img width="200px" src="{{ asset($products->thumb_image) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Thumbnail</label>
                                    <input type="file" class="form-control" name="thumb_img">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $products->name }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Category ID</label>
                                            <select id="inputState" class="form-control main-category" name="category">
                                                <option>Select</option>
                                                @foreach ($categories as $category)
                                                    <option {{ $category->id == $products->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Category ID</label>
                                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                                <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option {{ $sub_category->id == $products->sub_category_id ? 'selected' : '' }} value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Child Category ID</label>
                                            <select id="inputState" class="form-control child-category"
                                                name="child_category">
                                                <option value="">Select</option>
                                                @foreach ($child_categories as $child_category)
                                                    <option {{ $child_category->id == $products->child_category_id ? 'selected' : '' }} value="{{ $child_category->id }}">{{ $child_category->name }}</option>

                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Brand</label>
                                    <select id="inputState" class="form-control" name="brand">
                                        <option>Select</option>
                                        @foreach ($brands as $brand)
                                            <option {{ $brand->id == $products->brand_id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ $products->sku }}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ $products->price }}">
                                </div>
                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{ $products->offer_price }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{ $products->offer_start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{ $products->offer_end_date }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="number" min="0" class="form-control" name="stock_quantity"
                                        value="{{ $products->qty }}">
                                </div>
                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="text" class="form-control" name="video_link"
                                        value="{{ $products->video_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" name="short_description">{{ $products->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <div>
                                        <textarea name="long_description" class="form_control summernote">{!! $products->short_description !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ $products->seo_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Product Type</label>
                                    <select id="inputState" class="form-control" name="product_type">
                                        <option>Select</option>
                                        <option {{ $products->product_type == 'new_arrival' ? 'selected' : '' }} value="new_arrival">New Arrival</option>
                                        <option {{ $products->product_type == 'featured' ? 'selected' : '' }} value="featured">Featured</option>
                                        <option {{ $products->product_type == 'top_product' ? 'selected' : '' }} value="top_product">Top Product</option>
                                        <option {{ $products->product_type == 'best_product' ? 'selected' : '' }} value="best_product">Best Product</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <div>
                                        <textarea name="seo_description" class="form_control summernote">{!! $products->seo_description !!}</textarea>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $products->status == 1 ? 'active' : '' }} value="1">Active</option>
                                        <option {{ $products->status == 0 ? 'active' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>





                                <button class='btn btn-primary' type="submit">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $('.child-category').html('<option value="">Select</option>')
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",

                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html('<option value="">Select</option>')
                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-childcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html('<option value="">Select</option>')
                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
