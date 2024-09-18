@extends('admin.layouts.master')
@section('content')
    {{-- <h1 class="text-purple-900 text-4xl bg-teal-600">tailwind</h1> --}}
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image <code>(Multiple Image Supported)</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{ $product->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function() {
                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('admin.product.change-status') }}',
                        method: 'PUT',
                        data: {
                            status: isChecked,
                            id: id
                        },
                        success: function(data) {
                            toastr.success(data.message);

                        },
                        error: function(xhr, status, error) {
                            console.log(error)
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
