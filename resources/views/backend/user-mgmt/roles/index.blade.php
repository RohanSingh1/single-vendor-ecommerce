@extends ('backend.layouts.master')
@section('page_title')
    Roles
@endsection
@section('styles')
@endsection
@section('content-head-title')
  Roles
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Roles
                <div class="page-title-subheading">Here are all the Roles you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button class="btn btn-success" data-toggle="modal" data-target="#addForm">Add New</button>
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
                        All Category
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="table-responsive">
                      <table  class="table table-striped  table-bordered" id="datatable">
                          <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                            <tbody>
                              @foreach($data as $item)
                                  <tr class = "title item{{$item->id}}">
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$item->name}}</td>
                                      <td>
                                        <a href="#viewPermission" class="view-modal btn btn-xs btn-success btn-sm" data-ids="{{ $item->id }}" data-toggle="modal"><i class ="fa fa-eye" ></i></a>
                                        <a href="{{ route('admin.roles.edit',$item->id) }}" class="btn btn-xs btn-warning btn-sm"><i class ="fa fa-edit"></i></a>
                                      <a class="delete-modal btn btn-danger btn-sm" data-id="{{ $item->id }}" data-title ="{{$item->name}}"  data-toggle="modal" data-rel="delete" ><i class="fa fa-trash"></i></a>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    @include('backend.user-mgmt.roles.create-modal')
    @include('backend.user-mgmt.roles.view-permission')
    @include('inc.delete-modal')
@endsection
@push('script')
    <script type="text/javascript">
  $("#datatable").DataTable({
      ordering: true
  });
  $('#viewPermission').on('shown.bs.modal', function(e){
      console.log('this');
    $('#list').html('');
    var button = $(e.relatedTarget);
    var id = button.data('ids');

    $.ajax({
        type: "POST",
        url: "{{ route('admin.roles.show') }}",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: "id=" + id,
        success: function (msg) {
            setTimeout( function () {
            $('#list').html(msg);
            },500);
        },error:function(error ){
      console.log(error);
    }
    });
      $('#list').html('<div class = "text-center"><img width="90" src="{{ asset('backend/assets/icons/loading.gif') }}"><p>Fetching....</p></div>');
    });
    $(document).on('click', '.delete-modal', function() {
          $('.modal-title').text('Delete Role');
          $('.id').text($(this).data('id'));
          $('.deleteContent').show();
        //   $('.title').html($(this).data('title'));
          $('#myModal').modal('show');
      });
     $('.modal-footer').on('click', '.delete', function(){
        $.ajax({
          type: 'POST',
          url: '/user-management/roles/destroy',
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.id').text()
          },
          success: function(data){
             $('.item' + $('.id').text()).remove();
          },error:function(error ){
              console.log(error);
            }
        });
      });
</script>

@endpush
