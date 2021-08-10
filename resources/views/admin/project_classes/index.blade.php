@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="card">
      <div class="card-header">
        <a href="{{route('project_classes.create')}}" class="btn btn-primary float-right">New...</a>
        <h3><i class="fa fa-align-justify"></i> Project Classes</h3>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Texts</th>
              <th><span class="float-right">Actions</span></th>
            </tr>
          </thead>
          <tbody>
            @php 
            $langs = [];
            if ($project_classes->count() > 0){
              $n = $project_classes[0]->name;
              $langs[$n] = [];
              for($i=0; $i<$project_classes->count(); $i++){
                if ($project_classes[$i]->name != $n){
                  $n = $project_classes[$i]->name;
                  $langs[$n] = [];
                }
                array_push($langs[$n], $project_classes[$i]->text.'('.$project_classes[$i]->lang.')');
              }
            }
            @endphp
            @foreach($langs as $name => $lang)
            <tr id="{{$name}}">
              <td class="alias">{{$name}}</td>
              <td>{{implode(', ', $lang)}}</td>
              <td>
                <div class="btn-group-sm float-right" role="group">
                  <a class="btn btn-warning" href="{{route('project_classes.edit',$name)}}">Edit</a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal_remove" href="#" 
                  onclick="remove_item_click(this,'{{route('project_classes.index')}}','alias')">Remove</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $project_classes->links('admin.shared.pagination') }}
      </div>
    </div>
  </div>
</div>
@include('admin.shared.modal-remove')
@endsection
