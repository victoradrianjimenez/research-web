<div class="modal fade" id="modal_remove" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-danger" role="document">
    <div class="modal-content">
      <form action="" method="POST">
        {{method_field('DELETE')}}
        {{csrf_field()}}
        <div class="modal-header">
          <h4 class="modal-title">Delete entry</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="modal_info"></p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" name="cancel" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-danger" name="submit" type="submit">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function remove_item_click(elem, url, name_class){
    var table = $(elem).parentsUntil('table').parent();
    var rowObj = $(elem).parentsUntil('tr').parent();
    var id_element = rowObj.attr('id');
    var name = rowObj.children('.'+name_class).html();
    //actualizo datos en el modal
    $('#modal_remove .modal_info').html('Do you realy want to remove the entry for "'+name+'"?');
    $('#modal_remove form').attr('action',url + "/" + id_element);
    $('#modal_remove form').submit(function(){
      var respon = $.post($(this).attr('action'), $(this).serialize(), function(res){
        if (res.status === 'OK'){
          table.find('[id="'+id_element+'"]').remove(); //remove table item
        }
        showInfoNotification(res.message, res.status, '#');
      }).fail(function(){
        showInfoNotification('Unexpected error', '', '#');
      });
      $(this).find('[name="cancel"]').trigger("click"); //hide
      return false;
    });
    return true;
};
</script>