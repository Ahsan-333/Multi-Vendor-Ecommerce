@extends('admin.layouts.master')
@section('content')
{{-- <h1 class="text-purple-900 text-4xl bg-teal-600">tailwind</h1> --}}
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Brand Table</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Components</a></div>
              <div class="breadcrumb-item">Table</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Brands</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.brand.create') }}" class="btn btn-primary">Create New</a>
                    </div>
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
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.brand.change-status") }}',
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success:function(data){
                    toastr.success(data.message);

                },
                error: function(xhr, status, error){
                    console.log(error)
                }
            })
        })
        $('body').on('click', '.change-is_featured', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.brand.change-is_featured") }}',
                method: 'PUT',
                data: {
                    is_featured: isChecked,
                    id: id
                },
                success:function(data){
                    toastr.success(data.message);

                },
                error: function(xhr, status, error){
                    console.log(error)
                }
            })
        })
    })
  </script>

@endpush

@endsection
