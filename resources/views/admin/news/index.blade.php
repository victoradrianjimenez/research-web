@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('news.create')}}" class="btn btn-primary float-right"><i class="cil-plus"></i> New...</a>
        <h3><i class="fa fa-align-justify"></i> News</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>URL Name</th>
              <th>Author</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($news as $n)
            <tr id="{{$n->id}}">
              <td>{{$n->date}}</td>
              <td class="alias">{{$n->url}}</td>
              <td>{{$n->author}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-info" href="{{route('new', array_merge(explode('-',$n->date),[$n->url]))}}" title="View"><i class="cil-find-in-page"></i></a>
                  <a class="btn btn-warning" href="{{route('news.edit',$n->id)}}" title="Edit"><i class="cil-pencil"></i></a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('news.index')}}','alias')" title="Remove"><i class="cil-x-circle"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $news->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
