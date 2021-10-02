<div class="modal fade" id="modal_publication_search" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-primary" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Search publication</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="publication-search-form" action="{{route('publications_search')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <input class="form-control" type="text" name="key" placeholder="Key">
                <span class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                    <i class="cil-search"></i> Search
                  </button>
                </span>
              </div>
            </div>
          </div>
        </form>
        <table id="publication-search-table" class="table table-responsive-sm table-sm">
          <thead>
            <tr>
              <th>Citation</th>
              <th>Select</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" name="cancel" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="add" type="button" data-dismiss="modal">Add</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#publication-search-form').submit(function(){
    $('#publication-search-table tbody').empty();
    var respon = $.post($(this).attr('action'), $(this).serialize(), function(res){
      res.forEach(function(item){
        $('#publication-search-table tbody').append('<tr><td>'+
          item.citation+'</td><td>'+
          '<input type="checkbox" data-url="'+item.url+'" data-id="'+item.id+'">'+
          '</td></tr>'
        );
      });
    }).fail(function(){
      showInfoNotification('Unexpected error', '', '#');
    });
    return false;
  });
  $('#modal_publication_search button[name="add"]').click(function(){
    $('#publication-search-table input:checked').each(function(i,item){
      add_publication($(item).attr('data-id'), $(item).attr('data-url'));
    });
  });
</script>