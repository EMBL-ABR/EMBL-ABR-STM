<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>EMBL-ABR STM</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Footer theme -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <script src="https://digg.googlecode.com/files/Class-0.0.2.js"></script>
    <script type="text/javascript" src="js/search.js"></script>

    <script type="text/javascript">
      var s = new Search();

      function search(q, only_files) {
        s.search(q, only_files, true);
      }

      function view(v) {
        if(v == "table") {
          $('#results').html(s.table_view);
        } else if(v == "google") {
          $('#results').html(s.google_view);
        }
      }

      $( document ).ready(function() {
        $('#q').keyup(function(event){
          if(event.keyCode == 13){
            $('#search').click();
          }
        });
      });

      $(function() {
        $('#menu').load('menu.html');
      });
    </script>

  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">EMBL-ABR STM</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="starter-template">
        <img src="img/embl-au-logo.jpg" style="width: 35%; display: block; margin-left: auto; margin-right: auto; padding-bottom: 10px;"/>
        <h1>EMBL-ABR Search for Training Materials</h1>
        <p class="lead">Easily find bioinformatics training materials from institutions worldwide.</p>
      </div>

    <form class="form-horizontal">
      <div class="col-xs-7 col-xs-offset-2">
        <input class="form-control input-lg" type="text" placeholder="Search" id="q">
      </div>
      <div class="col-xs-2" style="padding-left: 0px;">
        <button class="btn btn-success btn-lg" onclick="search($('#q').val(), false);" id="search">Submit</button>
      </div>
    </form>

    </div> <!-- /container -->

    <footer class="footer">
      <div class="container">
        <p class="text-muted">&copy; EMBL-ABR 2016</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
