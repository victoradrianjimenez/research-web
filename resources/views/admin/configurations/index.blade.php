@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <h3><i class="fa fa-align-justify"></i> Configurations</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm" style="table-layout: fixed">
          <colgroup>
            <col style="width:20%">
            <col style="width:10%">
            <col style="width:60%">
            <col style="width:10%">
          </colgroup>  
          <thead>
            <tr>
              <th>Key</th>
              <th>Type</th>
              <th>Value</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($configurations as $c)
            <tr id="{{$c->name}}">
              <td class="alias">{{$c->name}}</td>
              <td>{{$c->type}}</td>
              <td>{{$c->value}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-warning" href="{{route('configuration.edit',$c->name)}}">Edit</a>
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
@endsection
