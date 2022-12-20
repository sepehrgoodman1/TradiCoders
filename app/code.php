<!DOCTYPE html>
<html lang="en">
  <head>




  </head>
  <body>

    <textarea id="<?php echo $tabname.'.'.$tabtype;?>" name="code" class="CodeArea">
        <?php echo readfile("codes/$userid/$tabname.txt"); ?>
    </textarea>

    <!-- Js Code -->

  </body>
</html>
