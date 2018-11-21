$(document).ready(function(){
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
      success: function(success) {
        if (success) {
          $('.alert').removeClass('dr')
          $('.alert').addClass('res');
          document.getElementById("formulario").reset();
        }
      },
      error: function(error) {
        console.log(error);
      }
    });
    return false;
  });
  
});


