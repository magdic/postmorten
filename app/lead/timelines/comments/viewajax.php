 <?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../../config/functions.php";

$idProject=$_REQUEST['id'];
if(isSet($_POST['idComment']))
{
$id=$_POST['idComment'];
// $idProject=$_POST['idProject'];
$com=mysql_query("SELECT * FROM subComment AS a, users AS b WHERE idFromComment='$id' AND a.userSubComment=b.id ORDER BY idSubComment");
while($r=mysql_fetch_array($com))
{
$c_id=$r['idSubComment'];
$idUserSub=$r['id'];
$comment=$r['subComment'];
$name=$r['name'];
$lastnameUser=$r['lastname'];
$dateSub=$r['dateSubComment'];




?>


<div class="comment_ui" >
<div class="comment_text">
  <div  class="comment_actual_text">
  	<div id="sssss"><?php echo '<span class="label label-success arrowed-in arrowed-in-right">'.$name.' '.$lastnameUser.'</div><div class="itemdiv dialogdiv"><div class="body"><div class="time"><i class="icon-time"></i><span class="green">'.$dateSub.'</span></div>'.$comment.'</div></div>'; ?></div>
  </div>
</div>
</div>


<?php } }?>
<div class="dddd">
<div>
<!-- <img src="profile.jpg" width="32" height="32" /> -->
    <form action="comments/savesubcomment.php" method="post">
      <div class="form-actions">
        <small><?php echo $name.' '.$lastnameUser; ?></small>
            <div class="input-group">
              <input name="idProject" type="hidden" value="<?php echo $idProject ?>" />
              <input name="mesgid" type="hidden" value="<?php echo $id ?>" />
              <input name="idUserSub" type="hidden" value="<?php echo $idUserSub ?>" />
              <input placeholder="Type your message here ..." type="text" class="form-control" name="mcomment">
              <span class="input-group-btn">
                <input class="btn btn-sm btn-info no-radius" type="submit">
              </span>
            </div>
          </div>
    </form>
</div>
</div>

