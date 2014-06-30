 <?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../../config/functions.php";


if(isSet($_POST['msg_id']))
{
$id=$_POST['msg_id'];
$com=mysql_query("SELECT * FROM subComment WHERE idComment='$id' ORDER BY idSubComment");
while($r=mysql_fetch_array($com))
{
$c_id=$r['idSubComment'];
$comment=$r['subComment'];
?>


<div class="comment_ui" >
<div class="comment_text">
<div  class="comment_actual_text"><img src="profile.jpg" width="32" height="32" /><div id="sssss"><?php echo $comment; ?></div></div>
</div>
</div>


<?php } }?>
<div class="dddd">
<div>
<img src="profile.jpg" width="32" height="32" />
<form action="savecomment.php" method="post">
<input name="mesgid" type="hidden" value="<?php echo $id ?>" />
<input name="mcomment" type="text" placeholder="Write a comment..." style="height: 24px; border:1px solid #BDC7D8; padding:3px; border-width: 1px 0px 1px 1px; width:302px;" />
<input id="buts" name="" type="submit" value="ENTER" />
</form>
</div>
</div>