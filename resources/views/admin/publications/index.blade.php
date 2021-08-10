@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('publications.create')}}" class="btn btn-primary float-right">New...</a>
        <h3><i class="fa fa-align-justify"></i> Publications</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Year</th>
              <th>Type</th>
              <th>Citation</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($publications as $p)
            <tr id="{{$p->id}}">
              <td>{{$p->year}}</td>
              <td>{{__('app.'.(($p->type)?:'undefined'))}}</td>
              <td class="alias">{!!$p->citation!!}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-info" href="{{route('publication',$p->url)}}">View</a>
                  <a class="btn btn-warning" href="{{route('publications.edit',$p->id)}}">Edit</a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('publications.index')}}','alias')">Remove</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $publications->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
