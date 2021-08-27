@php
    $firstFooterMenus = footerMenu('first-footer');
    $secondFooterMenus = footerMenu('second-footer');
    $thirdFooterMenus = footerMenu('third-footer');

    $facebook = get_general_settings_text('facebook');
    $twitter = get_general_settings_text('twitter');
    $google_plus = get_general_settings_text('google_plus');
    $instagram = get_general_settings_text('instagram');
    $linkedin = get_general_settings_text('linkedin');
    $pinterest = get_general_settings_text('pinterest');
@endphp
<footer class="footer">
    <div class="footer-first-row">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <ul class="call-email-alt">
                        <li>
                            <a href="#" class="callemail">
                            <i class="uil uil-dialpad-alt"></i>
                            @if(get_general_settings_text('phone_no') != '')
                            {{get_general_settings_text('phone_no')
                            ?get_general_settings_text('phone_no')->text:''}}@endif</a></li>
                        <li><a href="#" class="callemail"><i class="uil uil-envelope-alt"></i>
                            <span class="__cf_email__" data-cfemail="e980878f86a98e88848b869a9c998c9b84889b828c9dc78a8684">
                                [email&#160;@if(get_general_settings_text('ac_email') != '')
                                {{get_general_settings_text('ac_email')
                                ?get_general_settings_text('ac_email')->text:''}}@endif]</span></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="social-links-footer">
                        <ul>

                            @if($facebook)
                            <li><a href="{{$facebook->text ?? '#'}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            @endif

                            @if($twitter)
                            <li><a href="{{$twitter->text ?? '#'}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            @endif

                            @if($google_plus)
                            <li><a href="{{$google_plus->text ?? '#'}}" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                            @endif

                            @if($linkedin)
                            <li><a href="{{$linkedin->text ?? '#'}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif

                            @if($instagram)
                            <li><a href="{{$instagram->text ?? '#'}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif

                            @if($pinterest)
                            <li><a href="{{$pinterest->text ?? '#'}}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-second-row">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="second-row-item">
                        <h4>{{$firstFooterMenus->first()->menu->title}}</h4>
                        <ul>
                            @if(count($firstFooterMenus)>0)
                            @foreach($firstFooterMenus as $menu)
                            @if($menu->publishedPost)
                            <li><a href="{{$menu->publishedPost->post_type_id==1?url($menu->publishedPost->slug)
                                :$menu->publishedPost->url}}" {{targetBlank($menu->url_target)}}>
                                {{$menu->display_name??$menu->publishedPost->post_title}}</a></li>
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="second-row-item">
                        <h4>{{$secondFooterMenus->first()->menu->title}}</h4>
                        <ul>
                            @if(count($secondFooterMenus)>0)
                            @foreach($secondFooterMenus as $menu)
                            @if($menu->publishedPost)
                            <li><a href="{{$menu->publishedPost->post_type_id==1?url($menu->publishedPost->slug)
                                :$menu->publishedPost->url}}" {{targetBlank($menu->url_target)}}>
                                {{$menu->display_name??$menu->publishedPost->post_title}}</a></li>
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="second-row-item">
                        <h4>{{$thirdFooterMenus->first()->menu->title}}</h4>
                        <ul>
                            @if(count($thirdFooterMenus)>0)
                            @foreach($thirdFooterMenus as $menu)
                            @if($menu->publishedPost)
                            <li><a href="{{$menu->publishedPost->post_type_id==1?url($menu->publishedPost->slug)
                                :$menu->publishedPost->url}}" {{targetBlank($menu->url_target)}}>
                                {{$menu->display_name??$menu->publishedPost->post_title}}</a></li>
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="second-row-item-app">
                        <h4>Download App</h4>
                        <ul>
                            <li><a href="#"><img class="download-btn" src="{{ asset('front/images/download-1.svg') }}" alt=""></a></li>
                            <li><a href="#"><img class="download-btn" src="{{ asset('front/images/download-2.svg') }}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="second-row-item-payment">
                        <h4>Payment Method</h4>
                        <div class="footer-payments">
                            <ul id="paypal-gateway" class="financial-institutes">
                                <li class="financial-institutes__logo">
                                    <img alt="Visa" title="Visa" src="{{ asset('front/images/footer-icons/pyicon-6.svg') }}">
                                </li>
                                <li class="financial-institutes__logo">
                                    <img alt="Visa" title="Visa" src="{{ asset('front/images/footer-icons/pyicon-1.svg') }}">
                                </li>
                                <li class="financial-institutes__logo">
                                    <img alt="MasterCard" title="MasterCard" src="{{ asset('front/images/footer-icons/pyicon-2.svg') }}">
                                </li>
                                <li class="financial-institutes__logo">
                                    <img alt="American Express" title="American Express" src="{{ asset('front/images/footer-icons/pyicon-3.svg') }}">
                                </li>
                                <li class="financial-institutes__logo">
                                    <img alt="Discover" title="Discover" src="{{ asset('front/images/footer-icons/pyicon-4.svg') }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="second-row-item-payment">
                        <h4>Newsletter</h4>

                        <form action="{{ route('newsletter.store') }}" method="post">
                            @csrf
                            <div class="newsletter-input">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control input-md" required="">
                                <button class="newsletter-btn hover-btn" type="submit"><i class="uil uil-telegram-alt"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-last-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-links">
                        <ul>
                            <li><a href="about_us.html">About</a></li>
                            <li><a href="contact_us.html">Contact</a></li>
                            <li><a href="privacy_policy.html">Privacy Policy</a></li>
                            <li><a href="term_and_conditions.html">Term & Conditions</a></li>
                            <li><a href="refund_and_return_policy.html">Refund & Return Policy</a></li>
                        </ul>
                    </div>
                    <div class="copyright-text">
                        <i class="uil uil-copyright"></i>Copyright 2020 <b>Gambolthemes</b> . All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
