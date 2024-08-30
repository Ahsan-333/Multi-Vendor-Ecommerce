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
                  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Thumbnail</label>
                      <input type="file" class="form-control" name="thumb_img">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                      <label>Adress</label>
                      <input type="text" class="form-control" name="address" value="">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div>
                          <textarea name="description"  class="summernote"></textarea>
                        </div>
                      </div>
                    <div class="form-group">
                      <label>Facebook</label>
                      <input type="text" class="form-control" name="fb_link" value="">
                    </div>
                    <div class="form-group">
                      <label>X</label>
                      <input type="text" class="form-control" name="x_link" value="">
                    </div>
                    <div class="form-group">
                      <label>Instagram</label>
                      <input type="text" class="form-control" name="insta_link" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Is Featured</label>
                        <select id="inputState" class="form-control" name="is_featured">
                          <option value="">Select</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Category ID</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option>Select</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Sub Category ID</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                  <option>Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Child Category ID</label>
                                <select id="inputState" class="form-control child-category" name="child_category">
                                  <option>Select</option>
                                </select>
                            </div>
                        </div>
                    </div>




                    <button class='btn btn-primary' type="submit">Update</button>
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
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",

                    data: {
                        id : id
                    },
                    success: function(data){
                        $('.sub-category').html('<option>Select</option>')
                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    }, error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-childcategories') }}",
                    data: {
                        id : id
                    },
                    success: function(data){
                        $('.child-category').html('<option>Select</option>')
                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    }, error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>

@endpush
