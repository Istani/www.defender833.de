<div class="div-border rounded-corner div-shadow div-content">
  <h1>About: <?php echo $SYTH['youtube_channel']['youtube_snippet_title']; ?></h1>
  
  <table width="100%">
    <tr>
      <td><img src="<?php echo $SYTH['youtube_channel']['youtube_snippet_thumbnails_default_url']; ?>" alt="<?php echo $SYTH['youtube_channel']['youtube_snippet_title']; ?> avatar"></td>
      <td>
        <table>
          <tr>
            <td> &nbsp; </td><td>&nbsp;</td>
          </tr>
          <tr>
            <td> Gründung: </td><td><?php echo date("d.m.Y",strtotime($SYTH['youtube_channel']['youtube_snippet_publishedat'])); ?></td>
          </tr>
          <tr>
            <td> Videos: </td><td><?php echo $SYTH['youtube_channel']['youtube_statistics_videocount']; ?></td>
          </tr>
          <tr>
            <td> Abonnenten: </td><td><?php echo $SYTH['youtube_channel']['youtube_statistics_subscribercount']; ?></td>
          </tr>
          <tr>
            <td> Kanal: </td><td><a href="https://www.youtube.com/<?php echo $SYTH['youtube_channel']['youtube_snippet_customurl']; ?>"><?php echo "https://www.youtube.com/".$SYTH['youtube_channel']['youtube_snippet_customurl']; ?></a></td>
          </tr>
        </table>
      </td>
      <td>
        <table>
          <tr>
            <td> &nbsp; </td><td>&nbsp;</td>
          </tr>
          <tr>
            <td> &nbsp; </td><td>&nbsp;</td>
          </tr>
          <tr>
            <td> Views: </td><td><?php echo $SYTH['youtube_channel']['youtube_statistics_viewcount']; ?></td>
          </tr>
          <tr>
            <td> &nbsp; </td><td>&nbsp;</td>
          </tr>
          <tr>
            <td> Livestream: </td><td><a href="http://gaming.youtube.com/channel/<?php echo $SYTH['youtube_channel']['youtube_id']; ?>/live">Youtube Gaming</a></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <hr>
  <br>
  
  <center>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $SYTH['youtube_channel']['youtube_brandingsettings_channel_unsubscribedtrailer']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </center>
  
  <br>
  <hr>
  <br>
  <?php
  
  
  echo nl2br($SYTH['youtube_channel']['youtube_snippet_description']);
  ?>
  <br><br>
</div>
