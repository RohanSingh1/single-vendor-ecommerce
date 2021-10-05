<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                    </ol>
                </nav>
                @include('front.layouts.form_messages')
            </div>
        </div>
    </div>
</div>
<div class="dashboard-group">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-dt">
                    <form action="{{ route('front.uploadAvatar') }}" method="post" id="uploadAvatar" enctype="multipart/form-data">
                    @csrf
                    <div class="user-img">
                        <img src="{{ asset('storage/uploads/Front/User/'.auth()->user()->image) }}" alt="">
                        <div class="img-add">
                            <input type="file" id="file" name="image" onchange="$('#uploadAvatar').submit()">
                            <label for="file"><i class="uil uil-camera-plus"></i></label>
                        </div>
                    </div>
                    </form>

                    <h4>{{ auth()->user()->name }}</h4>
                    <p>{{ auth()->user()->phone_no }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
