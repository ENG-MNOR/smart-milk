<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.adminkit.io/pages-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Apr 2024 07:36:14 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
  <meta name="author" content="AdminKit" />
  <meta name="keywords"
    content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

  <link rel="preconnect" href="https://fonts.gstatic.com/" />
  <link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />

  <link rel="canonical" href="pages-sign-in-2.html" />

  <title>Sign In | AdminKit Demo</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet" />

  <!-- Choose your prefered color scheme -->
  <link href="../../css/light.css" rel="stylesheet">
  <link href="../../css/dark.css" rel="stylesheet">

  <!-- BEGIN SETTINGS -->
  <!-- Remove this after purchasing -->
  <!-- <link class="js-stylesheet" href="css/light.css" rel="stylesheet" />
  <script src="js/settings.js"></script>
  <style>
    body {
      opacity: 0;
    }
  </style>
  END SETTINGS -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-10"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "UA-120946860-10", { anonymize_ip: true });
  </script>
</head>
<!--
  HOW TO USE: 
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
  <main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">
            <div class="text-center mt-4">
              <h1 class="h2">Welcome back!</h1>
              <p class="lead">Sign in to your account to continue</p>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="m-sm-3">
                  <!-- <div class="d-grid gap-2 mb-3">
                      <a class="btn btn-google btn-lg" href="index.html"
                        ><i class="fab fa-fw fa-google"></i> Sign in with
                        Google</a
                      >
                      <a class="btn btn-facebook btn-lg" href="index.html"
                        ><i class="fab fa-fw fa-facebook-f"></i> Sign in with
                        Facebook</a
                      >
                      <a class="btn btn-microsoft btn-lg" href="index.html"
                        ><i class="fab fa-fw fa-microsoft"></i> Sign in with
                        Microsoft</a
                      >
                    </div> -->
                  <!-- <div class="row">
                    <div class="col">
                      <hr>
                    </div>
                    <div class="col-auto text-uppercase d-flex align-items-center">Or</div>
                    <div class="col">
                      <hr>
                    </div>
                  </div> -->
                  <form>
                    <div class="mb-3">
                      <label class="form-label">Phone Number</label>
                      <input class="form-control form-control-lg tell" type="number" name="email"
                        placeholder="Enter your " />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input class="form-control form-control-lg password" type="password" name="password"
                        placeholder="Enter your password" />
                      <small>
                        <a href="./forget.php">Forgot password?</a>
                      </small>
                    </div>
                    <div>
                      <div class="form-check align-items-center">
                        <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me"
                          name="remember-me" checked />
                        <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <a class="btn btn-lg btn-primary login">Sign in</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="text-center mb-3">
              Don't have an account? <a href="./pages-sign-up.php">Sign up</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../../js/app.js"></script>
  <script>
    $(document).ready(function () {
      // function displayMessage(message, time = 3000) {
      //   $(".error-handler").html(`
      //           <div class="alert alert-danger">
      //                 <strong class='text-dark'>${message}</strong>
      //               </div>

      //       `);
      //   setTimeout(() => {
      //     $(".error-handler").html("");
      //   }, time);
      // }
      // Your code here
      $(document).on("click", ".login", () => {
        alert("clicked");
        if ($(".tell").val() == "" || $(".password").val() == "") {
          alert("please enter FILL");
        } else {
          $.ajax({
            method: "POST",
            dataType: "JSON",
            data: {
              tell: $(".tell").val(),
              password: $(".password").val(),
              action: "validateAuth",
            },
            url: "../api/admin.php",
            success: (res) => {
              console.log(res);
              const { isFound, data } = res;
              // console.log(data);
              if (isFound) {
                console.log(data);

                // alert("username is correct");
                cit_id = data[0].cit_id;
                localStorage.setItem('cit_id', cit_id);
                window.location.href = "../../../../Bilciye/index.php";
              } else {
                alert("password or username is incorrect");
              }
            },
            error: (err) => {
              console.log(err);
            },
          });
        }
      });
    });
    // $(".login").click((e) => {

    // });
  </script>

  <!-- <script>
      document.addEventListener("DOMContentLoaded", function (event) {
        setTimeout(function () {
          if (localStorage.getItem("popState") !== "shown") {
            window.notyf.open({
              type: "success",
              message:
                'Get access to all 500+ components and 45+ pages with AdminKit PRO. <u><a class="text-white" href="https://adminkit.io/pricing" target="_blank">More info</a></u> 🚀',
              duration: 10000,
              ripple: true,
              dismissible: false,
              position: {
                x: "left",
                y: "bottom",
              },
            });

            localStorage.setItem("popState", "shown");
          }
        }, 15000);
      });
    </script> -->
</body>

<!-- Mirrored from demo.adminkit.io/pages-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Apr 2024 07:36:15 GMT -->

</html>