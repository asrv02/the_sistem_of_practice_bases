function error_show(text) {
  $('#error-text').html(text);
  
  $('#modal-error').modal('show');
}




$( document ).ready(function() {
  $.pjax.defaults.timeout = 5000
 
  function modalShow(student_practice_id) {       
    $.ajax({        
        'url' : '/practice-group/student-lists/modal-load',
        'method': 'post',
        'data': {
          'practice_group_id' : $('#modal-practice-body').data('practice_group_id'),
          'student_practice_id': student_practice_id
        },        
        'timeout': 5000,       
        success: function(data) {
          $("#modal-practice-body").html(data)
          $('#modal-practice').modal('show');
        }        
    });          
}
   


 $("#modal-practice").on('click', '.modal-practice-send', function(e) {
      e.preventDefault();
      if( !$('#id-org').val() && $('#place-practice').val() == '' ) {        
          error_show('Необходимо выбрать место проведения практики');
          return;
      }

      if( $('#id-org').val() && $('#place-practice').val() !== '' ) {
          error_show('Необходимо выбрать только одно место проведения практики');
          return;
      }

      $.ajax({
        'url' : '/practice-group/student-lists/practice-send',
          'method': 'post',
          'data': {            
            'student_practice_id': $('#modal-practice-body').find('.student-list').val(),
            'id_org' : $('#id-org').val(),
            'place_practice': $('#place-practice').val(),
            
          },
          'timeout': 5000,
          success: function(data) {           
            $('#modal-practice').modal('hide');
            $.pjax.reload({
              container: '#students-pjax', 
              push: false,
              type: 'POST'
            })
          },
          error: function(response, e) {
            error_show('Ошибка запроса');
          return;
          }       
      })



 })
    
    // отправка студента по кнопке в таблице
    $('#students-pjax').on('click', '.btn-student-set', function(e) {
        e.preventDefault();

        modalShow([$(this).data('student_practice_id')]);
       

    } )

    // отправка нескольких студентов
    $( ".btn-send-students" ).click(function(e) {
        e.preventDefault()

        const keys = $("#grid-students").yiiGridView("getSelectedRows");
        if( !keys.length ) {
            error_show('Необходимо выбрать студентов');
            return;
        }

        modalShow(keys)
    });
})
