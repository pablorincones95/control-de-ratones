(function(window) {
  console.log('gawfwa');
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
  var names = document.getElementById('names').value;
  var url = 'vendor/phpmailer/enviar.php';
  console.log(names);
  $.ajax({
    type: 'POST',
    url: url,
    data: $('#formulario').serialize(),
    success: function(data) {
      console.log('data')
    }
  });
  return false;
});