<?php
session_start();
require_once('database/db.php');
require_once('security/connexion.php');

if(isTokenValid($_SESSION['token'])){
    header("Location: /dashboard.php");
}
$error = false;
$requestMethod = $_SERVER['REQUEST_METHOD'];

    if($requestMethod == 'GET' && $_GET['sub'] == "true"){
            if(isset($_GET['mail']) && isset($_GET['pass'])){
                $logUser = loginWithToken($_GET['mail'], $_GET['pass']);
                if($logUser){
                    $_SESSION['token'] = $logUser;
                    header("Location: dashboard.php");
                }
                else{
                    $error = "Connexion impossible, utilisateur non-authentifié";
                }
            }
            else {
                $error = "Un champ de connexion manquant";
            }
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Garage train</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <div class="container-fluid">
      <?php
        if($error){
          ?><div class="alert alert-danger" role="alert">
            <?= $error ?>
          </div>
          <?php
        }
          ?>
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <h2 class="text-info fw-light mb-5"><i class="fa fa-car"></i>&nbsp;Garage Train</h2>
                    <form method="GET">
                        <div class="form-group mb-3"><label class="form-label text-secondary">Email</label><input class="form-control" type="text" required="" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                        <div class="form-group mb-3"><label class="form-label text-secondary">Mot de passe</label><input class="form-control" type="password" name="pass" required=""></div><button class="btn btn-info mt-2" name="sub" type="submit" value="true">Connexion</button>
                    </form>
                    <p class="mt-3 mb-0"></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image: url(&quot;https://images.assetsdelivery.com/compings_v2/auxins/auxins2302/auxins230200611.jpg&quot;);background-size: cover;background-position: center center;">
                <p class="ms-auto small text-dark mb-2"><em>Photo by Auxin Nopparat / auxins<br></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>