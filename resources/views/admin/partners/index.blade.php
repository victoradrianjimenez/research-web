@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('partners.create')}}" class="btn btn-primary float-right"><i class="cil-plus"></i> New...</a>
        <h3><i class="fa fa-align-justify"></i> Partners</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Logo</th>
              <th>Name</th>
              <th>Fullname</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($partners as $p)
            <tr id="{{$p->id}}">
              <td><img src="{{asset('assets/'.$p->logo)}}" height="32"></td>
              <td class="alias">{{$p->name}}</td>
              <td><a href="{{$p->link}}">{{$p->fullname}}</a></td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-warning" href="{{route('partners.edit',$p->id)}}" title="Edit"><i class="cil-pencil"></i></a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('partners.index')}}','alias')" title="Remove"><i class="cil-x-circle"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $partners->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
