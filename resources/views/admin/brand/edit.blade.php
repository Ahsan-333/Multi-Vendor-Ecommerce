@extends('admin.layouts.master')
@section('content')
{{-- <h1 class="text-purple-900 text-4xl bg-teal-600">tailwind</h1> --}}
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Brand</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Brand</h4>
                    <div class="card-header-action">



                    </div>
                  </div>
                  <div class="card-body">

                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Preview</label><br>
                            <img width="200px" src="{{ asset($brand->logo) }}" alt="">
                          </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $brand->name}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Is Featured</label>
                            <select id="inputState" class="form-control" name="is_featured">
                              <option {{ $brand->is_featured == 1 ? 'selected' : '' }}  value="1">Yes</option>
                              <option {{ $brand->is_featured == 0 ? 'selected' : '' }}  value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{ $brand->status == 1 ? 'selected' : '' }}  value="1">Active</option>
                              <option {{ $brand->status == 0 ? 'selected' : '' }}  value="0">Inactive</option>
                            </select>
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
