@extends('admin.layouts.master')
@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Vednor Profile</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Vendor Profile</h4>
                  </div>
                  <div class="card-body">
                  <form action="{{ route('admin.vendor-profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Banner</label>
                      <input type="file" class="form-control" name="banner">
                    </div>
                    <piv class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" name="phone">
                    </piv>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                      <label>Adress</label>
                      <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea name="description" value="{{ old('description') }}" class="summernote"></textarea>
                        </div>
                      </div>
                    <div class="form-group">
                      <label>Facebook</label>
                      <input type="text" class="form-control" name="fb_link" value="{{ old('fb_link') }}">
                    </div>
                    <div class="form-group">
                      <label>X</label>
                      <input type="text" class="form-control" name="x_link" value="{{ old('x_link') }}">
                    </div>
                    <div class="form-group">
                      <label>Instagram</label>
                      <input type="text" class="form-control" name="insta_link" value="{{ old('insta_link') }}">
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
