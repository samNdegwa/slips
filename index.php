
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="dashboard/assets/custom_css/login.css">
<script src="bs/js/jquery-3.3.1.js"></script>
<script src="jquery/cdnjs/jquery.min.js"></script>
<script src="bs/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fa/css/font-awesome.min.css">

	<title>Admin | SLCMC</title>
  <link rel="shortcut icon" href="dashboard/assets/dist/img/logo1.png" type="image/png">
</head>
<body>
<div class="login-container">
  <section class="login" id="login">
    <header>
      <h2 style='text-align:center;'><img src="dashboard/assets/dist/img/logo1.png" style="height:150px;width:150px;"></h2>
      
      <h6 style='text-align:center;color:red;' id="error"></h6>
    
    </header>
    <form class="login-form"  method="post" id="login-form" name="login">
      <input type="email" class="login-input" placeholder="Username" required autofocus/>
      <input type="password" class="login-input" placeholder="Password" required/>
      <div class="submit-container">
        <button type="submit" class="login-button" id="login-id"><i class="fa fa-sign-in" aria-hidden="true"></i> SIGN IN</button>
      </div>
    </form>
    
  </section>
  <p style="color:#17A2B8;">2022 - Sister Leonella Consolata Medical College</p>
</div>


</body>
</html>
<script>
// var form = document.getElementById('login');
// var buttonE1 = document.getElementById('e1');

// buttonE1.addEventListener('click', function () {
//   form.classList.add('error_1');
//   setTimeout(function () {
//     form.classList.remove('error_1');
//   }, 3000);
// });

$(document).ready(function(){
      $('#login-form').submit(function(e){
        e.preventDefault();
        attemptLogin();
      });
     });

     function attemptLogin(){
          var username = $('#login-form input:eq(0)').val();
          var password = $('#login-form input:eq(1)').val();

          var json = JSON.stringify([username,password]);
          $('#login-form button').html('<i class="fa fa-pulse fa-refresh"></i> Signing in');
          $.post('dashboard/core/login.php',
          {
            data:json
          },function(data,status){
             $('#login-form button').html('<i class="fa fa-lock"></i> Sign in ');
             if(data ==='success'){
              $('#login-form button').html('<i class="fa fa-pulse fa-refresh"></i> Redirecting ');
              document.location.href='./dashboard';
             }
             if (data === 'wrong')
             {

              document.getElementById('error').innerHTML='Ooops! Wrong Email/Password';
             }
             if (data === 'empty') {
              
              document.getElementById('error').innerHTML='Ooops! Wrong Email/Password';
             }
          }
          );

        }
</script>