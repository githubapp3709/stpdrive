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
        <form class="bg-white rounded p-5 signup-form" autocomplete="off">
          <h1 class="text-center bold">Sign up</h1>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" placeholder="Username" class="form-control" required="required">
          </div>
          <div class="mb-3 email_con">
            <label for="email" class="form-label">Email Id</label>
            <input type="email" id="email" placeholder="Email" class="form-control" required="required" d>
            <i class="fa fa-circle-notch fa-spin email_loader d-none"></i>
          </div>

          <div class="mb-3 pass_con">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" placeholder="Password" class="form-control" required="required">
            <i class="fa fa-eye pass_icon"></i>
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <div class="form-text">Click generate to improve security</div>
            <button class="btn btn-sm btn-danger pass-gen">Generate</button>
          </div>
          <div class="text-center">
            <button class="btn btn-primary w-50 register_btn" disabled="disabled">Register Now!</button>
          </div>
          <div class="msg"></div>
        </form>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      // generate Password
      $(".pass-gen").click(function(e) {
        e.preventDefault();
        $("#password").attr("type", "text");
        $(".pass_icon").css({
          color: "black"
        });
        $.ajax({
          url: "php/generate_password.php",
          type: "post",
          beforeSend: function() {
            $(".pass_icon").removeClass("fa fa-eye");
            $(".pass_icon").addClass("fa fa-circle-notch fa-spin");
          },
          success: function(data) {
            $(".pass_icon").removeClass("fa fa-circle-notch fa-spin");
            $(".pass_icon").addClass("fa fa-eye");
            $("#password").val(data.trim());
          }
        })
      })

      // show passwoard
      $(".pass_icon").click(function() {
        if ($("#password").attr("type") == "password") {
          $("#password").attr("type", "text");
          $(this).css({
            color: "black"
          });
        } else {
          $("#password").attr("type", "password");
          $(this).css({
            color: "#ccc"
          });
        }
      })
      // show spinner for mail

      $("#email").on('input', function() {
        $(".email_loader").removeClass("d-none");
      })

      //check already register users

      $("#email").on('change', function() {

        $.ajax({
          url: "php/check_user.php",
          type: "POST",
          data: {
            email: $(this).val()
          },
          success: function(response) {
            $(".email_loader").removeClass("fa fa-circle-notch fa-spin");
            if (response.trim() == "nofound") {
              $(".email_loader").removeClass("fa fa-times-circle");
              $(".email_loader").addClass("fa fa-check-circle");
              $(".email_loader").css({
                color: "green"
              })
              $(".register_btn").removeAttr("disabled");
            } else {
              $(".email_loader").removeClass("fa fa-check-circle");
              $(".email_loader").addClass("fa fa-times-circle");
              $(".email_loader").css({
                color: "red"
              })
              $(".register_btn").attr("disabled", "disabled");
            }
          }
        })
      })

      // inserting register data
      $(".signup-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: "php/register.php",
          type: "POST",
          data: {
            username: $("#username").val(),
            email: $("#email").val(),
            password: $("#password").val()
          },
          beforeSend: function() {
            $(".register_btn").html("Please wait...");
            $(".register_btn").attr("disabled", "disabled");
          },
          success: function(response) {
            if (response.trim() == "success") {
              $(".register_btn").html("Register Now!");
              $(".register_btn").removeAttr("disabled", "disabled");
              var div = document.createElement("div");
              div.className = "alert alert-success mt-3";
              div.innerHTML = "Registered Successfully !";
              $(".msg").append(div);

              setTimeout(function() {
                $(".msg").html("");
                $(".signup-form").trigger("reset");
              }, 3000)
            } else if (response.trim() == "usermatch") {
              var div = document.createElement("div");
              div.className = "alert alert-warning mt-3";
              div.innerHTML = "User already exists !";
              $(".msg").append(div);

              setTimeout(function() {
                $(".msg").html("");
                $(".signup-form").trigger("reset");
              }, 3000)
            } else {
              var div = document.createElement("div");
              div.className = "alert alert-danger mt-3";
              div.innerHTML = "Registration failed !";
              $(".msg").append(div);

              setTimeout(function() {
                $(".msg").html("");
                $(".signup-form").trigger("reset");
              }, 3000)
            }

          }
        })
      })

    })
  </script>
</body>

</html>