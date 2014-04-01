
<?php //SET JSON NAME TO CALL TIMELINE 
$idProject=$_REQUEST['id'];
$json_id = $idProject; 
?>
<!DOCTYPE html>
<html lang="en"><!--
  	 
  	88888888888 d8b                        888 d8b                888888   d8888b  
  	    888     Y8P                        888 Y8P                   88b d88P  Y88b 
  	    888                                888                       888 Y88b
  	    888     888 88888b d88b     d88b   888 888 88888b     d88b   888   Y888b
  	    888     888 888  888  88b d8P  Y8b 888 888 888  88b d8P  Y8b 888      Y88b
  	    888     888 888  888  888 88888888 888 888 888  888 88888888 888        888 
  	    888     888 888  888  888 Y8b      888 888 888  888 Y8b      88P Y88b  d88P 
  	    888     888 888  888  888   Y8888  888 888 888  888   Y8888  888   Y8888P
  	                                                                d88P            
  	                                                              d88P             
  	                                                            888P              
  	 -->
  <head>
    <title>Timeline JS Example</title>
    <meta charset="utf-8">
    <meta name="description" content="TimelineJS example">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Style-->
    <style>
      html, body { 
       height:100%;
       padding: 0px;
       margin: 0px;
      }
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML elements--><!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  </head>
  <body>
      <!-- BEGIN Timeline Embed -->
      <div><h1>Timeline App</h1>
        <a href="./?id=<?php echo $idProject;?>">Back</a>
      </div>
      <div id="timeline-embed"></div>
       <div><p>Comments</p></div>
      <script type="text/javascript">
        var timeline_config = {
         width: "100%",
         height: "80%",
         source: "../../../json.php?id=<?php echo $json_id;?>"
        }
      </script>
      <script type="text/javascript" src="build/js/storyjs-embed.js"></script>
      <!-- END Timeline Embed-->
  </body>
</html>