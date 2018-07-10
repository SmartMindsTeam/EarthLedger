function changeBtnType(id,type,site_url) {
  $.ajax({
    url: site_url,
    type: 'post',
    data: {id: id,type:type, _csrf: yii.getCsrfToken()},
    success: function (response) {
      if (response.error) {
        alert(response.message);
      } else {
        if (type == 1) {
          changeBtnClass('#interested','#may_be','#decline',id);
        } else if (type == 2) {
          changeBtnClass('#may_be','#interested','#decline',id);
        } else if (type == 3) {
          changeBtnClass('#decline','#interested','#may_be',id);
        }
        $('#detail_holder_'+id).find('.interested_count').html(response.interested);
        $('#detail_holder_'+id).find('.may_be_count').html(response.may_be);
        $('#detail_holder_'+id).find('.declined_count').html(response.decline);
      }
    }
  });
}

function changeBtnClass(clicked,class1,class2,id) {
  if (!$('#btn_holder_'+id).find(clicked).hasClass('btn-success')) {
    $('#btn_holder_'+id).find(clicked).addClass('btn-success'); 
  }

  $('#btn_holder_'+id).find(clicked).removeClass('btn-info');
  $('#btn_holder_'+id).find(class1).removeClass('btn-success');
  $('#btn_holder_'+id).find(class2).removeClass('btn-success');

  if (!$('#btn_holder_'+id).find(class1).hasClass('btn-info')) {
    $('#btn_holder_'+id).find(class1).addClass('btn-info');
  }
  if (!$('#btn_holder_'+id).find(class2).hasClass('btn-info')) {
    $('#btn_holder_'+id).find(class2).addClass('btn-info');
  }
}

function loadPopup(site_url,id,type) {
  $.ajax({
    url: site_url,
    type: 'post',
    data: {id: id,type:type, _csrf: yii.getCsrfToken()},
    success: function (response) {
      $('#user_list_body').html(response);
      $('#user_list_modal').modal('show');
    }
  });
}