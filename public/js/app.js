function showInfoNotification(msg, status, link) {
  $('body > .alert-wrapper').append($(
    '<div class="alert alert-dismissible show '+((status=='OK')?'alert-primary':'alert-danger')+'" role="alert">'+
    '<a href="'+ link +'">'+msg+'</a>'+
    '<button class="close" type="button" data-dismiss="alert" aria-label="Close">'+
    '<span aria-hidden="true">×</span>'+
    '</button>'+
    '</div>').last().delay(10000).fadeOut(200));
};