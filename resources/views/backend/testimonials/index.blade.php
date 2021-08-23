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
            <div>Testimonials
                <div class="page-title-subheading">Here are all the Testimonials you have
                </div>
            </div>
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
                        All Testimonials
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="supplier-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script type="text/javascript">
    $(function() {
        $('#supplier-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.datatable.testimonials') }}',
            columns: [
                { data: 'image', title:'Image'},
                { data: 'name', title:'Name'},
                { data: 'type', title:'Type'},
                { data: 'message', title:'Message'},
                { data: 'created_at', title:'Created At'},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush
