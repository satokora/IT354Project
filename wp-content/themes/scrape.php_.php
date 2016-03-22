<?php 
  if (isset($_POST['submit']){
      $url = trim($_POST['url']);
      $raw = file_get_contents($url);
      $newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
      $content = str_replace($newlines, "", html_entity_decode($raw));

      $start = strpos($content, '<div itemprop="recipeInstructions"');
      $end = strpos($content, '</div>') + 6;

      $instructions = substr($content, $start, $end - $start);

  }
 ?>


<form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
  <input type="text" id="url" name="url">
  <input type="submit" value="Get URL" name="submit" class="btn btn-primary">
</form>

<?php 
  if ($instructions!=""){
    echo $instructions;
  }
   ?>