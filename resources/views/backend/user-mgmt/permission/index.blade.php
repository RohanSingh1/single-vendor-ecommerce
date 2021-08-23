@extends ('backend.layouts.master')
@section('page_title')
    Permissions
@endsection
@section('styles')

@endsection
@section('content-head-title')
  Permissions
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Permission Details
                <div class="page-title-subheading">Here are all the permission you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="btn btn-info btn-outline pull-right" data-toggle="modal" data-target="#addForm"><i class="fa fa-plus"></i> &nbsp ADD</div>

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
                        <table  class="table table-striped table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Permission</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr class = "title item{{$item->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td><a href="permissions/{{$item->id}}/edit" class="btn btn-xs btn-warning btn-sm"><i class ="fa fa-edit"></i></a>
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
    @include('inc.delete-modal')
    @include('backend.user-mgmt.permission.add-modal')
@endsection
@push('script')
    <script type="text/javascript">
   $("#datatable").DataTable({
        ordering: true
    });
    $(document).on('click', '.delete-modal', function() {
          $('.modal-title').text('Delete Permission');
          $('.id').text($(this).data('id'));
          $('.deleteContent').show();
          //$('.title').html($(this).data('title'));
          $('#myModal').modal('show');
      });
     $('.modal-footer').on('click', '.delete', function(){
        $.ajax({
          type: 'POST',
          url: '/user-management/permissions/destroy',
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
