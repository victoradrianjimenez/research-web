@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('sections.create')}}" class="btn btn-primary float-right">New...</a>
        <h3><i class="fa fa-align-justify"></i> Sections</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>URL Name</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($sections as $s)
            <tr id="{{$s->id}}">
              <td>{{$s->url}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-info" href="{{url($s->url)}}">View</a>
                  <a class="btn btn-warning" href="{{route('sections.edit',$s->id)}}">Edit</a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('sections.index')}}','alias')">Remove</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $sections->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
