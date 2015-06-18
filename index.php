<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  include_once(dirname(__FILE__).'/controller/include.php');
  // ChromePhp::log("session", $_SESSION);
  $dbm = new DBMapper();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">LiveDoor RSS Viewer</a>
        </div>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-3">
          <h2>News Type</h2>
          <form method="POST" action="controller/form_controller.php" class="navbar-form navbar-left" role="form">
            <div class="form-group">
              <select class="form-control" name="rss_feed">
                <?php foreach(Constant::$RSS_URL as $key => $value){?>
                  <option value="<?php echo $key; ?>"><?php echo $key;?></option>
                <?php }?>
              </select><br/><br/>
              <button type="submit" class="btn btn-success" id="update-article">選択</button>
            </div>
          </form>
        </div>
        <div class="col-md-9">
          <h2><?php if(!isset($_SESSION["rss_feed"])){?>選択してください<?php }else{ echo $_SESSION["rss_feed"];}?></h2>
          <?php if(!isset($_SESSION["rss_contents"])){?>選択してください<?php }else{
            foreach(json_decode($_SESSION["rss_contents"], true) as $key => $val){
              echo RecordToHTML::echoHTML($dbm->searchByField('article', 'article_id', $key));
            }
          }?>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Ryo Soga 2015</p>
      </footer>
    </div> <!-- /container -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    </body>
</html>
