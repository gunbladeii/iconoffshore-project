<?php require('conn.php'); ?>
<?php
session_start();
if ($_SESSION['role'] != 'administrator')
{
      header('Location:index.php');
}

date_default_timezone_set("asia/kuala_lumpur");
$date = date('d-F-Y');
$datePHP = date('Y-m-d');

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$role = $mysqli->query("SELECT * FROM role");
$ED = mysqli_fetch_assoc($role);
$totalRows_role = mysqli_num_rows($role);

$loginD = $mysqli->query("SELECT * FROM login WHERE role NOT LIKE 'administrator' AND role NOT LIKE 'superadmin'");
$login = mysqli_fetch_assoc($loginD);
$totalRows_loginD = mysqli_num_rows($loginD);

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$a = 1;

if (isset($_POST['submit'])) {
      $mysqli->query("INSERT INTO `login` (`name`, `email`, `username`, `password`, `role`) VALUES ('$name', '$email', '$username', '$password', '$role')");
      header("location:user.php");
    }

?>
<!--
=========================================================
* Material Dashboard Dark Edition - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard-dark
* Copyright 2019 Icon Offshore (#)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    User Registration
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
          <img src="assets/img/apple-icon.png" class="img-thumbnail img-fluid">
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item active ">
            <a class="nav-link" href="user.php">
              <i class="material-icons">person</i>
              <p>User Registration</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="tables.php">
              <i class="material-icons">content_paste</i>
              <p>Announcement Setting</p>
            </a>
          </li>
          <!-- 
          <li class="nav-item ">
            <a class="nav-link" href="typography.php">
              <i class="material-icons">library_books</i>
              <p>Typography</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="icons.php">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="map.php">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="notifications.php">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item active-pro ">
                <a class="nav-link" href="upgrade.php">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">User Profile</a>
             <span class="badge badge-primary">Hi, <?php echo ucfirst($row_Recordset['name']);?></span>&nbsp
             <span class="badge badge-info">Role: <?php echo strtoupper($row_Recordset['role']);?></span>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="javascript:void(0)">Mike John responded to your email</a>
                  <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                  <a class="dropdown-item" href="javascript:void(0)">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                  <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="material-icons">exit_to_app</i>
                  <p class="d-lg-none d-md-block">
                   Logout
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">User Registration</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                  <form method="post" action="user.php" role="form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" class="form-control" name="username">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" name="email">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" class="form-control" name="name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <select name="role" class="custom-select browser-default" required>
                              <option value="" selected>Choose role</option>
                               <?php do {?>
                               <option value="<?php echo $ED['roleName']?>"><?php echo strtoupper($ED['roleName'])?></option>
                               <?php }while ($ED = mysqli_fetch_assoc($role))?>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="bmd-label-floating">Password</label>
                                    <input type="password" class="form-control" id="txtPassword" name="password">
                                    <div class="input-group-append input-group-text">
                                          <span onclick="togglePassword()" class="material-icons">visibility</span>
                                    </div>
                                </div>
                              </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="bmd-label-floating">Confirm Password</label>
                                    <input type="password" class="form-control" id="txtConfirmPassword">
                                    <div class="input-group-append input-group-text">
                                          <span onclick="togglePasswordConfirmPassword()" class="material-icons">visibility</span>
                                    </div>
                                </div>
                              </div>
                      </div>
                      <!--end col-md-6-confirm-password-->
                    </div>
                      <!--end row-->

                    <button type="submit" name="submit" class="btn btn-primary pull-right" onclick="return Validate()">Register</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          <!--under row//-->
          </div>
          <div class="row">
            <div class="col-md-12">
                <?php if ($totalRows_loginD > 0) { ?>
                  <table id="example1" class="table table-hover table-responsive-xl">
                    <thead class="table-info">
                    <tr style="text-align:left">
                      <th scope="col">No</th></th>
                      <th scope="col">Name</th></th>
                      <th scope="col">Emailr</th>
                      <th scope="col">Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Role</th>
                      <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:left">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal" data-target="#editStaffModal" data-whatever1="<?php echo $login['id'];?>" class="badge badge-light" role="button" aria-pressed="true"><?php echo ucwords(strtolower($login['name']));?></a>
                      </td>
                      <td><?php echo $login['email'];?></td>
                      <td><?php echo $login['username'];?></td>
                      <td><?php echo $login['password'];?></td>
                      <td><?php echo strtoupper($login['role']);?></td>
                      <td>
                          <a data-toggle="modal" data-target="#deleteStaffModal" data-whatever2="<?php echo $login['noIC'];?>" class="badge badge-danger" role="button" aria-pressed="true" style="color:white">Del</a>
                      </td>
                    </tr>
                    <?php } while ($login = mysqli_fetch_assoc($loginD)); ?>
                    </tbody>
                  </table>
                <?php }?>
            </div>
          </div>
          <!--under row//-->
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://iconvessel.com/icon">
                  Icon Offshore
                </a>
              </li>
              <li>
                <a href="https://iconvessel.com/icon">
                  About Us
                </a>
              </li>
              <li>
                <a href="https://iconvessel.com/icon">
                  Team
                </a>
              </li>
              <li>
                <a href="https://iconvessel.com/icon">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right" id="date">
            , made with <i class="material-icons">favorite</i> by
            <a href="https://iconvessel.com/icon" target="_blank">Icon Offshore</a>.
          </div>
        </div>
      </footer>
      <script type="text/javascript">
          function Validate() {
              var password = document.getElementById("txtPassword").value;
              var confirmPassword = document.getElementById("txtConfirmPassword").value;
              if (password != confirmPassword) {
                  alert("Passwords do not match.");
                  return false;
              }
              return true;
          }

          function togglePassword() {
            var x = document.getElementById("txtPassword");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }

          function togglePasswordConfirmPassword() {
            var x = document.getElementById("txtConfirmPassword");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
      </script>
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
      </script>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple active" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-1.jpg" alt="">
          </a>
        </li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-2.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-3.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-4.jpg" alt="">
          </a>
        </li>
        <!-- <li class="header-title">Want more components?</li>
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                  Get the pro version
                </a>
            </li> -->
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script src="assets/datatables/jquery.dataTables.js"></script>
  <script src="assets/datatables/dataTables.bootstrap4.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>