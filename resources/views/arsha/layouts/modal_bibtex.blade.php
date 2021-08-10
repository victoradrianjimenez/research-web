<div class="modal fade" id="modal_bibtex_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('BibTex Entry')}}</h4>
        <a class="close" data-dismiss="modal" aria-label="{{__('Close')}}"><i class="ri-close-line"></i></a>
      </div>
      <div class="modal-body">
        <pre>{{$bibtex}}</pre>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Close')}}</button>
      </div>
    </div>
  </div>
</div>