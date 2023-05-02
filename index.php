<?php include('app/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="public\css\bootstrap.min.css">
    <style>
    </style>
    <title>AJ-Building</title>
</head>
<body style= "background-image: url('public/assets/asphalt.jpg');
            background-repeat: no-repeat;
            z-index: -3;
            background-size: 100vw 100vh">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="<?php echo $URL?>/public/assets/car.png" alt="AJ-BUILDING" width="19" height="30">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Promotions
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Monthly</a></li>
            <li><a class="dropdown-item" href="#">Daily</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Tickets</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled active">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Sign In</button>
    </div>
  </div>
</nav>

<br>
<div class="container">
  <div class="row">
    <?php
    $query_mapping = $pdo->prepare("SELECT ID_MAP, NUM_SPOT, FREE FROM tb_mappings WHERE AVAILABLE = 1");
    $query_mapping->execute();
    $mappings = $query_mapping->fetchAll(PDO::FETCH_ASSOC);
    foreach ($mappings as $mapping) {
      $id_map = $mapping['ID_MAP'];
      $num_spot = $mapping['NUM_SPOT'];
      $free = $mapping['FREE'];
      if ($free == 1) {?>
      <div class="col">
        <center>
          <h2><?php echo $num_spot;?></h2>
          <button class="btn btn-success" style="width: 100%; height: 109px">
          <p>FREE</p>
          </button>
        </center>
      </div>
      <?php
      }else {?>
      <div class="col">
        <center>
          <h2><?php echo $num_spot;?></h2>
          <button class="btn btn-danger">
            <img src="<?php echo $URL?>/public/assets/car.png" alt="" width="60px">
          </button>
        </center>
      </div>
      <?php
      }
    }
    ?>
  </div>
</div>
    <script src="public\js\jquery-3.6.4.min.js"></script>
    <script src="public/js/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Sign In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">User/Email</label>
                    <input type="email" id="txtUser" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" id="txtPassword" class="form-control">
                </div>
            </div>
        </div>
        <div id="response"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn_signIn">Sign In</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#btn_signIn').click(function() {
    login();
});

$('#txtPassword').keypress(function (e) {
  if (e.which == 13) { //ASCII de Enter = 13
    login();
  }
});

function login(){
  var usuario = $('#txtUser').val();
  var password_user = $('#txtPassword').val();

  if (usuario == "") {
    alert('Debes introducir tu usuario')
    $('#txtUser').focus();
  }else if(password_user == ""){
    alert('Debes introducir tu contraseña')
    $('#txtPassword').focus();
  }else{
    var url = 'login/controller_login.php'
    $.post(url, {usuario:usuario, password_user:password_user}, function (datos) {
      $('#response').html(datos);
    });
  }
}

</script>