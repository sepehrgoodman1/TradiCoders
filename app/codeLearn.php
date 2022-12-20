<?php
$sql_code = selectQuery_tc_Academy("id='$tabname'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>

      <script>
          if (them === 'dark'){
              BgClass = 'BgDark';
          }else {
              BgClass = 'BgWhite';
          }
          descriptions[<?php echo $sql_code[0]['id'] ?>]=`<div class="P_TextAreaApp">
                <textarea name="" class="TextAreaApp `+BgClass+` AlmostBlack"><?php echo $sql_code[0]['input'] ?></textarea>
              </div>
              <div  class="P_TextArea">
                <textarea name="" class="TextAreaApp `+BgClass+` AlmostBlack"><?php echo $sql_code[0]['output'] ?></textarea>
              </div>`;
      </script>

  </head>
  <body>

    <textarea id="<?php echo $tabname.'.'.$tabtype;?>" name="code" class="CodeArea">
        <?php
        echo $sql_code[0]['code'];
        ?>
    </textarea>

    <!-- Js Code -->

  </body>
</html>
