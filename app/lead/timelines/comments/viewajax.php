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
<div  class="comment_actual_text">
	<div id="sssss"><?php echo $comment; ?></div></div>
</div>
</div>


<?php } }?>
<div class="dddd">
<div>
<!-- <img src="profile.jpg" width="32" height="32" /> -->
                            <form action="comments/savesubcomment.php" method="post">
                              <div class="form-actions">
                                <small><?php echo $nameUser.' '.$lastnameUser; ?></small>
                                    <div class="input-group">
                                      <input name="idProject" type="hidden" value="<?php echo $idProject ?>" />
                                      <input name="mesgid" type="hidden" value="<?php echo $id ?>" />
                                      <input placeholder="Type your message here ..." type="text" class="form-control" name="mcomment">
                                      <span class="input-group-btn">
                                        <input class="btn btn-sm btn-info no-radius" type="submit">
                                      </span>
                                    </div>
                                  </div>
                            </form>
</div>
</div>