<?php
require_once "config.php";
?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="<?php echo $site['base_dir']; ?>favicon.ico" type="image/x-icon">
  <title><?php echo $SYTH['youtube_channel']['youtube_snippet_title']; ?></title>
  <link href="<?php echo $site['base_dir']; ?>style/main_style.css" type="text/css" rel="stylesheet">
  
  <script type="text/javascript">
  function change_all_links(){
    for (var linkNum = 0; linkNum < document.links.length; linkNum++){
      var findTxt = 'http://<?php echo $_SERVER["HTTP_HOST"]; ?>';
      var linktext = String(document.links[linkNum]);
      var sublink=linktext.substr(0,findTxt.length);
      if (sublink!=findTxt) {
        document.links[linkNum].target="_blank";
      }
    }
  };
</script>

</head>
<body>
  <center>
    <table>
      <tr>
        <td>
          <div class="div-border rounded-corner div-shadow" style="width:1060px;height:173px">
            <?php
            echo '<img src="'.$SYTH['youtube_channel']['youtube_brandingsettings_image_bannerimageurl'].'" alt="'.$SYTH['youtube_channel']['youtube_snippet_title'].' banner">';
            ?>
          </div>
          <br>
        </td>
      </tr>
      <tr>
        <td>
          <div class="div-border rounded-corner div-shadow">
            <ul class="nav">
              <li class="nav"><a href="<?php echo $site['base_dir']; ?>">About me</a></li>
              <li class="nav"><a href="<?php echo $site['base_dir']; ?>Videos">Videos</a></li>
              <li class="nav"><a href="<?php echo $site['base_dir']; ?>Games">Games & More</a></li>
            </ul>
          </div>
          <br>
        </td>
      </tr>
      <tr>
        <td>
          <?php
          if (!isset($_GET['kategorie'])) {$_GET['kategorie']="";}
          if (!isset($_GET['details'])) {$_GET['details']="";}
          
          switch ($_GET['kategorie']) {
            case 'Videos':
            include("pages/video_list.php");
            break;
            case 'Video':
            include("pages/video_play.php");
            break;
            default:
            include("pages/about_me.php");
            
          }
          
          ?>
          <br>
        </td>
      </tr>
      <tr>
        <td>
          <div class="div-border rounded-corner div-shadow">
            FOOTER
          </div>
          <br>
        </td>
      </tr>
    </table>
  </center>
  <script type="text/javascript">
  change_all_links();
  </script>
</body>
</html>
