@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('register')}}" class="btn btn-primary float-right"><i class="cil-plus"></i> New...</a>
        <h3><i class="fa fa-align-justify"></i> Users</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $u)
            <tr id="{{$u->id}}">
              <td>{{$u->name}}</td>
              <td class="alias">{{$u->email}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-warning" href="{{route('users.edit',$u->id)}}" title="Edit"><i class="cil-pencil"></i></a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('users.index')}}','alias')" title="Remove"><i class="cil-x-circle"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
