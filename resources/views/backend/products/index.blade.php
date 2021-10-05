@extends('backend.layouts.master')
@section('styles')
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Products
                    <div class="page-title-subheading">Here are all the products you have
                    </div>
                </div>
            </div>
            @can('product-create')
                <div class="page-title-actions">
                    <a href="{{ route('admin.products.create') }}">
                        <button class="btn btn-success">Add New</button>
                    </a>
                </div>
            @endcan
        </div>
    </div>
    @include('inc.messages')
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Products
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content table-responsive">
                        <table class="table table-striped table-bordered" id="product-table">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.api.product') }}',
                order: [[1, "asc"]],
                columns: [
                    {data: 'image', title: 'Image'},
                    {data: 'name', title: 'Product Name'},
                    {data: 'model_no', title: 'Model Name'},
                    {data: 'quantity', title: 'Quantity'},
                    {data: 'price', title: 'Price'},
                    {data: 'is_featured', title: 'Featured'},
                    {data: 'front_view', title: 'Site View'},
                    {data: 'action', name: 'action', title: 'Action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
@endpush
