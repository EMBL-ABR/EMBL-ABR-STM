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
    <script src="https://use.fontawesome.com/73dcd3ddec.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <!--<script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://digg.googlecode.com/files/Class-0.0.2.js"></script> -->
    <script type="text/javascript" src="js/class.js"></script>
    <script type="text/javascript" src="js/search.js"></script>

    <style>
      .starter-template {
          text-align: center;
      }
    </style>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-79997520-1', 'auto');
      ga('send', 'pageview', "/");

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
          <a class="navbar-brand" href="https://www.embl-abr.org.au/">EMBL-ABR</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="sources.html">Sources</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="starter-template">
        <div class="container">
          <row>
            <div class="col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
              <a href='https://www.embl-abr.org.au/'><img src="img/embl-au-logo.jpg" style="width: 100%; display: block; margin-left: auto; margin-right: auto; padding-bottom: 10px;"/></a>
            </div>
          </row>
        </div>
        <h1>EMBL-ABR Search for Training Materials <span class="label label-default" style="font-size: 50%; vertical-align: middle;">Beta</span></h1>
        <p class="lead" id="search_form_scroll">Easily find bioinformatics training materials from institutions worldwide.</p>
      </div>
    </div>
    <div class="container" style="padding-top: 10px;">
      <form class="form-horizontal">
        <div class="col-md-7 col-md-offset-2 col-xs-9 col-sm-7 col-sm-offset-2">
          <input class="form-control input-lg" type="text" placeholder="Search" id="q">
        </div>
        <div class="col-xs-2" style="padding-left: 0px;">
          <button type="button" class="btn btn-success btn-lg" onclick="srch($('#q').val(), false, true);" id="search">Submit</button>
        </div>
      </form>
    </div>

    <div class="container" id="bar_filter" style="padding-top: 20px; display: none;">
      <div class="col-xs-3 col-xs-offset-2">
        <p class="lead" id="num_results"></p>
      </div>
      <div class="col-xs-3" style="padding-left: 0px;">
        <p class="lead"><a href="#collapseExample" data-toggle="collapse" class="collapsed" aria-hidden="true" id="collapse_opts">Options <span id="optionsicon" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></p>
      </div>
    </div>

    <div class="collapse" id="collapseExample">
      <div class="container">
        <div style="clear: left;">
          <div class="col-xs-3 col-xs-offset-2">
            <h4> Filter </h4>
          </div>
          <div class="col-xs-3" style="padding-left: 0px;">
            <h4> Sort </h4>
          </div>
          <div class="col-xs-3" style="padding-left: 0px;">
            <h4> View </h4>
          </div>
          <div class="col-xs-1"></div>
        </div>
      </div>
      <div class="container">
        <div class="btn-toolbar" role="toolbar" style="clear: left;">
          <div class="col-xs-3 col-xs-offset-2">
            <div class="btn-group" data-toggle="buttons" aria-label="filter">
              <label class="btn btn-success active" id="filter_none"><input type="radio" name="options" autocomplete="off">None</label>
              <label class="btn btn-success" id="filter_files"><input type="radio" name="options"  autocomplete="off">Files Only</label>
            </div>
          </div>
          <div class="col-xs-3" style="padding-left: 0px;">
            <div class="btn-group" data-toggle="buttons" aria-label="sort">
              <label class="btn btn-success active" id="sort_default"><input type="radio" name="options" autocomplete="off">Default</label>
              <label class="btn btn-success" id="sort_title"><input type="radio" name="options" autocomplete="off">Title</label>
              <label class="btn btn-success" id="sort_site"><input type="radio" name="options" autocomplete="off">Site</label>
            </div>
          </div>
          <div class="col-xs-3" style="padding-left: 0px;">
            <div class="btn-group" data-toggle="buttons" aria-label="view">
              <label class="btn btn-success active" id="view_default"><input type="radio" name="options" autocomplete="off">Default</label>
              <label class="btn btn-success" id="view_google"><input type="radio" name="options" autocomplete="off">Google</label>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <div class="container" style="padding-top: 20px">
      <div class="col-xs-10 col-xs-offset-1">
        <div id="results">
          <div class="row" style="padding-top:10px;">

              <div class="col-xs-10 col-xs-offset-1">
                <div class="alert alert-success text-center" role="alert">Note: EMBL-ABR STM is currently in beta and has a limit of 100 queries per 24 hours. </div>
              </div>
              </div>
          </div>
      </div>
    </div>

    <div class="container">
      <div class="col-md-12 text-center">
        <nav>
          <ul class="pagination" id="pages">

          </ul>
        </nav>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"></p>
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

    <!-- Custom js for searching, filtering, etc -->
    <script type="text/javascript">
      var s = new Search();

      // ----------------
      // SEARCH FUNCTIONS
      // ----------------

      function srch(q, only_files, q_changed) {
        if(q_changed) {
          // Reset the options and ensure options are hidden at first.
          s = new Search();
          resetFilter();
          resetSort();
          resetView();

          // Google analytics
          ga('send', 'pageview', 'search?q=' + q);

          // This is to hide the options bar
          $('#collapse_opts').addClass('collapsed');
          $('#collapse_opts').attr("aria-hidden","true");
          $('#collapse_opts').attr("aria-expanded", "false");
          $('#collapseExample').attr("aria-expanded", "false");
          $('#collapseExample').removeClass("in");
        }

        // Do search
        s.search(q, only_files, true);

        window.history.pushState('search', 'EMBL-ABR STM', '/' + "?q=" + q);
        var divPosition = $('#search_form_scroll').offset();
        $('html, body').animate({scrollTop: divPosition.top}, "slow");

      }

      $("#q").on( "keypress", function(event) {
        // If user presses enter in search box
        // act like they pushed submit and do the search

        if (event.which == 13 && !event.shiftKey) {
            event.preventDefault();
            srch($('#q').val(), false, true);
        }
      });


      // ----------------
      // HELPER FUNCTIONS
      // ----------------

      function getUrlVars() {
        // Get the query from the URL
        // This will occur if user has come from home page
        // Or has bookmarked search URL
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
        });
        return vars;
      }

      function view(v) {
        // Change the view between table and google
        if(v === "table") {
          $('#results').html(s.get_table_view());
        } else if(v === "google") {
          $('#results').html(s.get_google_view());
        }
      }


      // -----------------------------------------
      // DOCUMENT READY FUNCTION - CHECK FOR QUERY
      // -----------------------------------------

      $( document ).ready(function() {
        // If we have a query already in URL then get it and search
        var q = getUrlVars()["q"];
        if(q) {
          srch(q, false, true);
          var txtbox = document.getElementById("q");
          txtbox.value = decodeURI(q);
        }
      });


      // --------------------------------------
      // RESETTING FUNCTIONS FOR OPTION BUTTONS
      // --------------------------------------

      function resetSort() {
        $('#sort_default').addClass('active');
        $('#sort_title').removeClass('active');
        $('#sort_site').removeClass('active');
      }

      function resetFilter() {
        $('#filter_none').addClass('active');
        $('#filter_files').removeClass('active');
      }

      function resetView() {
        $('#view_default').addClass('active');
        $('#view_google').removeClass('active');
      }


      // ------------------------
      // ONCLICK EVENTS - FILTERS
      // ------------------------

      $('#filter_none').on('change', function(){
        srch($('#q').val(), false, false);
        resetFilter();
        resetSort();
      });

      $('#filter_files').on('change', function(){
        srch($('#q').val(), true, false);
        resetSort();

        $('#filter_none').removeClass('active');
        $('#filter_files').addClass('active');
      });


      // ------------------------
      // ONCLICK EVENTS - SORTING
      // ------------------------

      $('#sort_default').on('change', function() {
        if($('#filter_none').hasClass('active')) {
          srch($('#q').val(), false, false);
        } else {
          srch($('#q').val(), true, false);
        }
      });

      $('#sort_title').on('change', function() {
        s.sort_by('title');
      });

      $('#sort_site').on('change', function(){
        s.sort_by('link');
      });


      // ----------------------
      // ONCLICK EVENTS - VIEWS
      // ----------------------

      $('#view_default').on('change', function(){
        view('table');
        resetView();
      });

      $('#view_google').on('change', function(){
        view('google');
        $('#view_default').removeClass('active');
        $('#view_google').addClass('active');
      });

    </script>

  </body>
</html>
