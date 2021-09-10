@extends('backend.layouts.master')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .help-block{
        color:rebeccapurple;
    }
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }

    .liststyle {
        list-style: none;
    }

    .liststyle li {
        float: left;
        padding-left: 12px;
    }
    .display-inline{
        display: inline-block;
    }
</style>
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Coupon
                <div class="page-title-subheading">Here are all the Coupons you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button class="btn btn-success" data-toggle="modal" data-target="#addCoupon">Add New</button>

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
                        All Coupon
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="coupon-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('backend.coupons.add-modal')
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
        $('.select2').select2({placeholder: 'Select Options',width: 'resolve'});
        $('.product-list').select2({
            placeholder: 'Select Product',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('admin.search.product') }}",
                dataType: 'json',
                type: 'GET',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    return {
                        results: data
                    };
                },
                cache: true
            }

        });
    </script>
    <script type="text/javascript">
    $(function() {
        $('#coupon-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.api.coupon') }}',
            columns: [
                { data: 'coupon_name', title:'Coupon Name'},
                { data: 'coupon_code', title:'Coupon Code'},
                { data: 'type', title:'Type'},
                { data: 'value', title:'Coupon Discount Value'},
                { data: 'expiry_date', title:'Expiry Date'},
                {data:'status',title:'Status', mRender:  function(data, type, full) {
                    return data == 1 ? 'Active' : 'In-Active';
            }},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush
