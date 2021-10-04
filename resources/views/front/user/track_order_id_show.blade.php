@extends('front.layouts.layout')

@push('css')
<link href="{{ asset('front/css/step-wizard.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<style>

    #test{
        margin-top: 35px;
    }
</style>
@endpush
@section('content')
    <div class="container" id="test">
        <div class="row">
            <div class="col-sm-12">

                <div class="track-order">
                    <h4>Order Status of Order Id ({{ $data['my_orders'][0]->order_track_id }})</h4>
                    <a href="{{ route('track_order_id') }}" class="btn btn-info">Track Another Order</a>
                    <div class="bs-wizard" style="border-bottom:0;">
                        @foreach (\App\Model\DeliveryName::where('step','!=',0)->where('status',1)->orderBy('step','asc')->get() as $key=>$dn)
                        <div class="bs-wizard-step
                        @if($dn->delivery_name == $data['my_orders'][0]->status)
                        active
                        @php
                            $active =true;
                        @endphp
                        @elseif (isset($active))
                        disabled
                        @else
                         complete
                        @endif
                        ">
                            <div class="text-center bs-wizard-stepnum">{{ $dn->delivery_name }}</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="bs-wizard-dot"></a>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
