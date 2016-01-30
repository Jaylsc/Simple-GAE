<?php

if(!file_exists("config.php"))
{
	header("location: ./install.php");
	die;
}

if (!empty($_GET["file"]))
{
	$f = $_GET["file"];
	
	$f = str_replace(".php","",$f);
	
	// remote file inclusion attempt fix
	if (strpos($f,".")!==false)
		die("+1 for you");
		
	$f = "demos/$f.php";

	if (!file_exists($f))
		die("+1 for you");

	$code = file_get_contents($f);
	
	// removed db settings
	$code = preg_replace("/mysql_connect(.*)/i","mysql_connect('localhost','user','pass');",$code);
	
	highlight_string($code);
	echo "<br>&nbsp;";
	die;
}	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DEMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
	body {
		padding-top: 60px;
		padding-bottom: 40px;
	}
	.sidebar-nav {
		padding: 9px 0;
	}
	.nav
	{
		margin-bottom:10px;
	}	
	.accordion-inner a {
		font-size: 13px;
		font-family:tahoma;
	}
	.alert {
		padding:8px 14px 8px 14px;
	}
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">DEMO</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
                <a target="_blank" href="logout.php" class="navbar-link">Logout</a>
            </p>
            <ul class="nav">
                
              <li><a target="_blank" href="admin.php">Home</a></li>
               <li><a target="_blank" href="#">Reserve</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
            
			<div class="accordion" id="accordion_menu">
						
                            <li><a href="userhistory.php" target="frame">Hisory</a></li>
                               <li><a href="guideline.php" target="frame">Guideline</a></li>
                                        
			</div>	  
        </div><!--/span-->
		
        <div class="span10">
          <div class="row-fluid">
            <div class="span12">
			
				<ul class="nav nav-tabs" id="grid-demo-tabs">
					<li class="active"><a href="#demo" data-toggle="tab">Demo</a></li>
					
				</ul>
				
				<div class="tab-content" id="grid-demo-tabs-content">
				  
					<div id="demo" class="tab-pane fade in active">
		        		<span id="span_version" style="display:none">
		        		<a id="div_version" style="margin-left:18px; width:100px; font-family: tahoma; padding:5px; background-color: #117AC0; letter-spacing:1px; color: white; text-decoration:underline;" target="_blank" href="http://www.phpgrid.org/download/"></a>
						<br>
						</span>						
                                            <iframe onload="iframeLoaded(this)" name="frame" frameborder="0" width="100%" height="500" src="userhistory.php"></iframe>
					</div>
				  
					<div id="code" class="tab-pane fade">
					</div>
				  
				</div>

            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
		
		<div class="row-fluid">
			<div class="span12">
			  <div class="row-fluid">
				<div class="alert alert-info">
					<a name="contact"></a>
                                        <p><a href="user.php">DEMO</a> <?php echo date("Y") , date("M") , date("d");?></p>
				</div><!--/span-->
			  </div><!--/row-->
			</div><!--/span-->
		  </div><!--/row-->
		  
      </div><!--/row-->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
		
			$('#grid-demo-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			})
			
			
			function iframeLoaded(iFrameID) 
			{
				if(iFrameID) 
				{
			        iFrameID.height = "600px";
					if(iFrameID.contentDocument){
						iFrameID.height = iFrameID.contentDocument.body.offsetHeight + 35;
					} else {
						iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + 45 + "px";
					}
				}
				
				if (!stop)
				setTimeout(function(){iframeLoaded(iFrameID,1);},1000);
			}
		</script>
    </div><!--/.fluid-container-->

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-50875146-1', 'phpgrid.org');
	  ga('send', 'pageview');
	</script>

  </body>
</html>
