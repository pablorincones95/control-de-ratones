$(document).ready(function() {
  (function(window) {
    // Transition effect for navbar 
    $(window).scroll(function() {
      // checks if window is scrolled more than 500px, adds/removes solid class
      if ($(this).scrollTop() > 500) {
        $('.navbar').addClass('solid');
      } else {
        $('.navbar').removeClass('solid');
      }
    });
  })(window);


  $('#formulario').submit(function() {
    var url = 'vendor/phpmailer/enviar.php';
    $.ajax({
      type: 'POST',
      url: url,
      data: $('#formulario').serialize(),
      beforeSend: function(xhr) {
        $('#btn-submit').html('Enviando...');
      },
      complete: function() {
        $('#btn-submit').html('Enviado');
      }
    }).done(function(response) {
      console.log(response);
      $('#msg').html('<div class ="alert alert-success">Formulario enviado gracias</div>');
      $("#formulario")[0].reset();
    }).fail(function(data) {
      if (data.responseText !== '') {
        $('#msg').html('<div class ="alert alert-danger">' + data.responseText + '</div>');
      } else {
        $(formMessages).text('O');
      }
      $("#formulario")[0].reset();
    });
    return false;
  });

});