@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_upload" href="#"><i class="cil-plus"></i> New...</a>
        <h3><i class="fa fa-align-justify"></i> Assets</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Size</th>
              <th>Last Modified</th>
              {{--<th>URL</th>--}}
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($assets as $f)
            <tr id="{{$f->name}}">
              <td class="alias">{{$f->name}}</td>
              <td>{{($f->size<1e6) ? number_format($f->size/1e3,1).' kB' : 
                   (($f->size<1e9) ? number_format($f->size/1e6,1).' MB' : 
                                     number_format($f->size/1e9,1).' GB' )}}</td>
              <td>{{(new DateTime)->setTimestamp($f->time)->format('Y-m-d H:i:s')}}</td>
              {{--<td>{{asset('assets/'.$f->name)}}</td>--}}
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-primary" href="#" onclick="copyTextToClipboard('/assets/'+$(this).parentsUntil('tbody').find('.alias').html());return false;"><i class="cil-copy"></i></a>
                  <a class="btn btn-warning" data-toggle="modal" data-target="#modal_rename" href="#" 
                  onclick="rename_item_click(this,'{{route('assets.index')}}','alias')" title="Rename"><i class="cil-pencil"></i></a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('assets.index')}}','alias')" title="Remove"><i class="cil-x-circle"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-primary" role="document">
    <div class="modal-content">
      <form method="POST" action="{{route('assets.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-header">
          <h4 class="modal-title">Upload New File</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal_info">Choose a local file:</p>
          <input type="file" name="asset"><br>
            @error('asset')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="modal-footer">
          <button class="btn" type="reset">Reset</button>
          <button class="btn btn-secondary" name="cancel" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" name="submit" type="submit">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_rename" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-warning" role="document">
    <div class="modal-content">
      <form method="POST" action="" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="modal-header">
          <h4 class="modal-title">Rename</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal_info">New name of file:</p>
          <input class="form-control" type="text" name="name" value="{{old('name')}}"><br>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" name="cancel" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-warning" name="submit" type="submit">Rename</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function rename_item_click(elem, url, name_class){
    var table = $(elem).parentsUntil('table').parent();
    var rowObj = $(elem).parentsUntil('tr').parent();
    var id_element = rowObj.attr('id');
    var name = rowObj.children('.'+name_class).html();
    //actualizo datos en el modal
    $('#modal_rename form [name="name"]').val(name);
    $('#modal_rename form').attr('action',url + "/" + name);
    return true;
  };
  $(function() {
    if ($('#modal_rename .invalid-feedback').html()){
      $('#modal_rename').modal('show');
    }
    if ($('#modal_upload .invalid-feedback').html()){
      $('#modal_upload').modal('show');
    }
  });
</script>
@endsection