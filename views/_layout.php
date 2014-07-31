<?php 
  $settings = $this->get_settings(); 
  $session =  $this->get_session();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->request->lang; ?>">
  <head>
    <title><?php echo $this->meta->title; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?php echo $this->meta->description; ?>">
    <meta name="keywords" content="<?php echo $this->meta->keywords; ?>">
    <meta name="author" content="<?php echo $this->meta->author; ?>">
    <link rel="image_src" href="<?php echo $this->meta->image; ?>"/>
    <meta property="og:title" content="<?php echo $this->meta->title; ?>" />
    <meta property="og:image" content="<?php echo $this->meta->image; ?>" />
    <meta name="twitter:title" content="<?php echo $this->meta->title; ?>">
    <meta name="twitter:image" content="<?php echo $this->meta->image; ?>">  
    <link href="http<?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') { echo 's'; }; ?>://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="/css/site.css" />
  </head>
  <body >
  <div class="navbar navbar-fixed-top header">
    <div class="col-md-12">
    <div class="navbar-header">
      <a href="<?php echo $this->route_url(NULL, 'home'); ?>" class="navbar-brand"><?php echo @$settings->blog_name; ?></a>
      <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1"> 
      <i class="glyphicon glyphicon-search"></i>
      </button> -->
    </div>
<!--    <div class="collapse navbar-collapse" id="navbar-collapse1">
      <form class="navbar-form pull-right">
      <div class="input-group" style="max-width:470px;">
        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
        <div class="input-group-btn">
        <button class="btn btn-default btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
      </div>
      </form>
    </div>  -->
    </div> 
  </div>
  <div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
    <div class="navbar-header">
<!--      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Home <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
      <li><a href="#"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Profile</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-dashboard" style="color:#0000aa;"></i> Dashboard</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Pages</a></li>
      <li class="nav-divider"></li>
      <li><a href="#"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-plus"></i> More..</a></li>
      </ul> -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse2">
      <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">~pub</a></li>
      <li><a href="#">~mfer</a></li>
      <li><a href="#loginModal" role="button" data-toggle="modal">~4050</a></li>
      <li><a href="#aboutModal" role="button" data-toggle="modal">~4057</a></li>
      </ul>
    </div>  
    </div> 
  </div>

    <div class="container" id="main">
        
      <?php $this->render_body(); ?>

<?php
global $keys;
$keys = null;
is_readable('/home/mfer/Downloads/trello-backup/trello-org-UFMG-FALE-board-4050.json') && $keys = json_decode(file_get_contents('/home/mfer/Downloads/trello-backup/trello-org-UFMG-FALE-board-4050.json'));
$k = get_object_vars($keys);
//echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
//print_r($k["cards"]);
//echo "</pre>\n";

echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
foreach($k["cards"] as $card){
  $c = get_object_vars($card);
  print_r($c["idShort"]." ".$c["shortLink"]);

  $fn = '/home/mfer/Downloads/trello-backup/card-'.$c["idShort"].'.json';
  
  is_readable($fn) && $actions = json_decode(file_get_contents($fn));
  
  if(!file_get_contents($fn)) echo "deu false";
  else {
    echo file_get_contents($fn);
    //echo json_decode(file_get_contents($fn));
  }

  //$a = get_object_vars($actions);
  //print_r($a);
  echo "<br>----------------------------<br>\n";
}
echo "</pre>\n";

?>

      <div class="row">
        <br>
        <div class="clearfix"></div>
          <hr>
          <div class="col-md-12 text-center"><p>
            Powered by <a href="https://github.com/aidewind/aide" target="_blank">aide</a> 
            | <a href="<?php echo $this->route_url(NULL, 'admin'); ?>">Admin</a>
            <?php if ($session !== NULL ) { ?>| <a href="<?php echo $this->route_url('logoff', 'admin'); ?>">Logoff</a><?php }?>
          </div>
          <hr>
      </div>
    </div>

  </body>

  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  <!-- JavaScript jQuery code from Bootply.com editor -->
  <script type='text/javascript'>
    $(document).ready(function() {
    /* toggle layout */
    $('#btnToggle').click(function(){
      if ($(this).hasClass('on')) {
      $('#main .col-md-6').addClass('col-md-4').removeClass('col-md-6');
      $(this).removeClass('on');
      }
      else {
      $('#main .col-md-4').addClass('col-md-6').removeClass('col-md-4');
      $(this).addClass('on');
      }
    });
    });
  </script>

</html>