@extends('admin.layouts.master')
@section('content')
{{-- <h1 class="text-purple-900 text-4xl bg-teal-600">tailwind</h1> --}}
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Sub Category</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Sub Category</h4>
                    <div class="card-header-action">



                    </div>
                  </div>
                  <div class="card-body">

                    <form action="{{ route('admin.sub-category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputState">Category ID</label>
                            <select id="inputState" class="form-control" name="category">
                              <option>Select</option>
                              @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
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
