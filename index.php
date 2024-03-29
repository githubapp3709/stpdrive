<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- customized css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- bootstrap js -->
   <script src="js/bootstrap.bundle.min.js"></script>
  <!-- jquery google library -->
  <script src="js/jquery.min.js"></script>
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
  <div class="container-fluid">
    <a class="navbar-brand ms-3" href="#">
      <img src="images/logo.png" alt="logo" width="90px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item ps-3 pe-5">
          <a class="nav-link" href="#">About us</a>
        </li>
        <li class="nav-item px-3 bg-light rounded me-3">
          <a class="nav-link text-dark" href="#">Login</a>
        </li>      
    </ul>  
    </div>
  </div>
</nav>
<!-- container -->
<div class="container main-con">
  <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6 p-5">
      <form class="bg-white rounded p-5 sign-form" autocomplete="off">
              <h1 class="text-center bold">Sign up</h1>
              <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" placeholder="Username" class="form-control">
              </div>
              <div class="mb-3">
              <label for="email" class="form-label">Email Id</label>
              <input type="email" id="email" placeholder="Email" class="form-control">
              </div>

              <div class="mb-3 pass_con">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" placeholder="Password" class="form-control">
              <i class="fa fa-eye pass_icon"></i>
              </div>
              <div class="mb-3 d-flex justify-content-between">
                <div class="form-text">Click generate to improve security</div>
                <button class="btn btn-sm btn-danger pass-gen" >Generate</button>
              </div>
              <div class="text-center">
              <button class="btn btn-primary w-50">Register Now!</button>
              </div>
        </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
  // generate Password
  $(".pass-gen").click(function(e){
    e.preventDefault();
    $("#password").attr("type","text");
      $(".pass_icon").css({color:"black"});
    $.ajax({
      url:"php/generate_password.php",
      type:"post",
      success:function(data){
        $("#password").val(data.trim());
      }
    })
  })
  $(".pass_icon").click(function(){
    if($("#password").attr("type")=="password"){
      $("#password").attr("type","text");
      $(this).css({color:"black"});
    }
    else{
      $("#password").attr("type","password");
      $(this).css({color:"#ccc"});
    }
  })
})
</script>
  </body>
</html>

