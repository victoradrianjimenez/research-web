@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('members.create')}}" class="btn btn-primary float-right">New...</a>
        <h3><i class="fa fa-align-justify"></i> Members</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Order</th>
              <th>Photo</th>
              <th>Username</th>
              <th>Email</th>
              <th>Date registered</th>
              <th>Type</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($members as $m)
            <tr id="{{$m->id}}">
              <td>{{$m->order}}</td>
              <td><img src="{{asset('storage/'.$m->photo)}}" height="32"></td>
              <td class="alias">{{$m->fullname}}</td>
              <td>{{$m->email}}</td>
              <td>{{$m->created_at}}</td>
              <td>{{__('app.'.$m->type)}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-info" href="{{route('member', $m->url)}}">View</a>
                  <a class="btn btn-warning" href="{{route('members.edit',$m->id)}}">Edit</a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('members.index')}}','alias')">Remove</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $members->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection