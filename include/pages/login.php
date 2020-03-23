<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <title>Bootstrap Admin Template </title>
    <link rel="shortcut icon" href="<?php echo $ASSET_URL ?>img/favicon.ico">
    
    <!-- global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>css/font-icon-style.css">
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>css/style.default.css" id="theme-stylesheet">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>css/pages/login.css">
</head>

<body>
<?php

if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) && isset($_SESSION['msg_type'])) {
    if($_SESSION['msg_type']==1)
        echo '<input id="error-msg" data-type="success"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    else if($_SESSION['msg_type']==-1)
        echo '<input id="error-msg" data-type="error"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    else
        echo '<input id="error-msg" data-type="warn"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    $_SESSION['error_msg'] = '';
    $_SESSION['msg_type'] = '';

}

//var_dump($_SESSION);exit;
?>
<!--====================================================
                        PAGE CONTENT
======================================================--> 
      <section class="hero-area">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12 ">
                <div class="contact-h-cont">
                  <h3 class="text-center"><img src="img/logo.png" class="img-fluid" alt=""></h3><br>
                  <form action="requests/login.php" method="post">
                    <div class="form-group text-left">
                      <label for="username" class="text-left">Username</label>
                      <input required type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>  
                    <div class="form-group text-left">
                      <label for="exampleInputEmail1" class="text-left">Password</label>
                      <input required placeholder="Enter password" class="form-control" type="password" value="" name="password" id="password">
                    </div>   
                    <button class="btn btn-general btn-blue" type="submit" role="button"><i fa fa-right-arrow></i>Login</button>
                  </form>
                </div>
            </div>
          </div>  
        </div>
      </section>
      
    <!--Global Javascript -->
    <script src="<?php echo $ASSET_URL ?>js/jquery.min.js"></script>
    <script src="<?php echo $ASSET_URL ?>js/tether.min.js"></script>
    <script src="<?php echo $ASSET_URL ?>js/bootstrap.min.js"></script>
</body>

</html>