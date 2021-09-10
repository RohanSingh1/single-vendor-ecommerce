@extends('front.layouts.layout')

@section('content')

<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="all-product-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="panel-group accordion" id="accordion0">
                    <iframe style="border: 0;" width="100%" height="450"
                    src="{{ get_general_settings_text('map_code') }}" __idm_frm__="201"></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact-title">
                    <h2>Submit customer service request</h2>
                    <p>If you have a question about our service or have an issue to report, please send a request and we
                        will get back to you as soon as possible.</p>
                </div>
                <div class="contact-form">
                    <form action="{{ route('contact-us.store') }}"  method="POST">
                        @include('front.layouts.form_messages')
                     @csrf
                        <div class="form-group mt-1">
                            <label class="control-label">Full Name*</label>
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="text" name="name" value="{{ old('name') }}"
                                        required="" placeholder="Your Full Name">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <label class="control-label">Email Address*</label>
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="email" name="email"
                                    value="{{ old('email') }}" required="" placeholder="Your Email Address">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <label class="control-label">Contact Number*</label>
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="text" name="phoneNo"  value="{{ old('phoneNo') }}"
                                       required="" placeholder="Contact Number">

                                </div>
                                @error('phoneNo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <label class="control-label">Address*</label>
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="text" name="address"  value="{{ old('address') }}"
                                       required="" placeholder="Address">

                                </div>
                                @error('address')
                                       <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <label class="control-label">Subject*</label>
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="text" name="subject"  value="{{ old('subject') }}"
                                       required="" placeholder="Subject">

                                </div>
                                @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <div class="field">
                                <label class="control-label">Message*</label>
                                <textarea rows="2" class="form-control" id="sendermessage" name="message"
                                    required="" placeholder="Write Message">{{ old('message') }}</textarea>

                            </div>
                            @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                        <button class="next-btn16 hover-btn mt-3" type="submit" data-btntext-sending="Sending...">Submit
                            Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
