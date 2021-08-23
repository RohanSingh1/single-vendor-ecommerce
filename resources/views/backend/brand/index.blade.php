@extends('backend.layouts.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Brand
                <div class="page-title-subheading">Here are all the brands you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button class="btn btn-success" data-toggle="modal" data-target="#addbrand">Add New</button>

        </div>
    </div>
</div>
@include('inc.messages')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Brands
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="brand-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('backend.brand.add-modal')
@endsection
@push('script')
    <script type="text/javascript">
    $(function() {
        $('#brand-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.api.brand') }}',
            columns: [
                { data: 'brand_name', title:'Brand Name'},
                {data:'status',title:'Status', mRender:  function(data, type, full) {
                    return data == 1 ? 'Active' : 'In-Active';
            }},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush
