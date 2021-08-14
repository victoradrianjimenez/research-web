@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('projects.create')}}" class="btn btn-primary float-right"><i class="cil-plus"></i> New...</a>
        <h3><i class="fa fa-align-justify"></i> Projects</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Title</th>
              <th>Code</th>
              <th>Period</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($projects as $p)
            <tr id="{{$p->id}}">
              <td><img src="{{asset('assets/'.$p->logo)}}" height="32"></td>
              <td class="alias">{{$p->title}}</td>
              <td>{{$p->code}}</td>
              <td>{{$p->period}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-info" href="{{route('project',$p->url)}}" title="View"><i class="cil-find-in-page"></i></a>
                  <a class="btn btn-warning" href="{{route('projects.edit',$p->id)}}" title="Edit"><i class="cil-pencil"></i></a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('projects.index')}}','alias')" title="Remove"><i class="cil-x-circle"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $projects->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
