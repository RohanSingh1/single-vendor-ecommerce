<nav class="navbar navbar-expand-lg rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent"
        style="display: unset !important;">
        <ul class="nav nav-pills mr-auto justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link text-light" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="{{ isset($new)? 'fa fa-bell':'fa fa-bell-o' }}" style="margin-top:10px"></i>
                    <span class="totaln_count">{{auth('admin')->user()->unreadNotifications()->count() }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="head text-light bg-dark">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <span>Notifications ({{ auth()->user()->notifications->count() }})</span>
                                @if(auth()->user()->notifications->count() > 0)
                                 <a href="{{ route('admin.markAllAsRead') }}" class="float-right text-light">Mark all as read</a>
                                 @endif
                            </div>
                    </li>
                @if(auth('admin')->user()->notifications->count() > 0)
                   @foreach(auth('admin')->user()->notifications as $notification)
                   @if ($loop->iteration == 10)
                   @break
                   @endif
                   <li>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            {{--  <notifications title="{{ $notification->data['data']['title'] }}"
                                description="{{ $notification->data['data']['body'] }}"></notifications>  --}}
                                <a href="{{ route('admin.orders.index') }}">
                                <strong class="text-success" style="font-size: 15px;">{{ $notification->data['data']['title'] }}</strong>
                               <div>
                                   <small class="text-info" style="font-size: 14px;">{{ $notification->data['data']['body'] }}</small>
                                   </div>
                                </a>
                                <a href="javascript:void(0)" class="markAsRead" style="float: right" attr_id="{{ $notification->id }}">
                                @if($notification->read_at != null)
                                <i class="fa fa-circle-o"></i>
                                @else
                                <i class="fa fa-circle"></i>
                                    @endif
                                </a>
                        </div>
                        </div>
                   </li>

                   @endforeach
                   @else
                   <li class="notification-box">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <p style="text-align: center;color:red">
                                Sorry No Notification Found 
                            </p>
                        </div>
                    </div>
                </li>
                   @endif
                    <li class="footer bg-dark text-center">
                        <a href="{{ route('admin.notifications_list') }}" class="text-light">View All</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
