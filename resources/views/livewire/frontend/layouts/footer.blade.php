<div>
    <div id="home-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer__about footer-content">
                        <h6>About RST Online</h6>
                        <p>{!! get_general_settings_text('footer_text')->text??'' !!}</p>
                        <div class="footer__social">
                            @if($facebook)
                                <a class="facebook" target="_blank" href="{{$facebook->text ?? '#'}}"><i
                                            class="fa fa-facebook"></i></a>@endif
                            @if($twitter)
                                <a class="twitter" target="_blank" href="{{$twitter->text ?? '#'}}"><i
                                            class="fa fa-twitter"></i></a>@endif
                            @if($google_plus)
                                <a class="google-plus" target="_blank" href="{{$google_plus->text ?? '#'}}"><i
                                            class="fa fa-google-plus"></i></a>
                            @endif
                            @if($instagram)
                                <a class="instagram" target="_blank" href="{{$instagram->text ?? '#'}}"><i
                                            class="fa fa-instagram"></i></a>@endif
                            @if($youtube)
                                <a class="youtube" target="_blank" href="{{$youtube->text ?? '#'}}"><i
                                            class="fa fa-youtube"></i></a>
                            @endif
                            @if($linkedin)
                                <a class="linkedin" target="_blank" href="{{$linkedin->text ?? '#'}}"><i
                                            class="fa fa-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                @if(count($firstFooterMenus)>0)
                <div class="col-lg-2 offset-1 col-md-6">
                    <div class="footer__widget footer-content">
                        <h6>{{$firstFooterMenus->first()->menu->title}}</h6>
                        <ul>
                            @foreach($firstFooterMenus as $menu)
                                @if($menu->publishedPost)
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i>
                                <a href="{{$menu->publishedPost->post_type_id==1?url($menu->publishedPost->slug):$menu->publishedPost->url}}" {{targetBlank($menu->url_target)}} >{{$menu->display_name??$menu->publishedPost->post_title}}</a>
                            </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="col-lg-2  col-md-6">
                    <div class="footer__widget footer-content">
                        <h6>{{$secondFooterMenus->first()->menu->title}}</h6>
                        <ul>
                            @foreach($secondFooterMenus as $menu)
                                @if($menu->publishedPost)
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i>
                                <a href="{{$menu->publishedPost->post_type_id==1?url($menu->publishedPost->slug):$menu->publishedPost->url}}" {{targetBlank($menu->url_target)}}>{{$menu->display_name??$menu->publishedPost->post_title}}</a>
                            </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer__newslatter footer-content">
                        <h6>Contact Us</h6>
                        <ul>
                            <li> <b>Phone</b>: {{get_general_settings_text('phone_no')?get_general_settings_text('phone_no')->text:''}}</li>
                            <li><b>Email</b>: {{get_general_settings_text('ac_email')?get_general_settings_text('ac_email')->text:''}}</li>
                            <li><b>Location</b>: {{get_general_settings_text('address')?get_general_settings_text('address')->text:''}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright © {{now()->format('Y')}} All Rights Reserved
                | {{get_general_settings_text('site_title')?get_general_settings_text('site_title')->text:app_name()}}
                .</p>
        </div>
    </div>
</div>
</main>
</div>
<!-- FINISH -->

</div>
