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


  $('#formulario').submit(function(event) {
    event.preventDefault();
    let host = 'smtp.gmail.com';
    let adressee = 'pablorincones95@gmail.com';
    let password = 'v--24418291';
    let formName = 'Formulario de control de ratones';
    let names = document.getElementById('names').value;
    let email = document.getElementById('email').value;
    let subject = document.getElementById('subject').value;
    let message = document.getElementById('message').value;

    let body = ` 
      <div>
        <p>Nombre: ${names} </p>
        <p>Asunto: ${subject} </p>
        <p>Mensaje: ${message} </p>
      </div>
    `;

    Email.send({
      Host: host,
      Username: adressee,
      Password: password,
      To: adressee,
      From: email,
      Subject: formName,
      Body: body
    }).then(message => {

      if (message === 'OK') {
        document.getElementById('msg').innerHTML = '<div class ="alert alert-success">Formulario enviado gracias</div>';
      } else {
        document.getElementById('msg').innerHTML = '<div class ="alert alert-danger">A ocurrido un error intente mas tarde</div>';
      }
      document.getElementById('formulario').reset();
    });
  });

});