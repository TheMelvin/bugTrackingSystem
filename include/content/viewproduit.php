<?php
    $id = $dataproduit['bug_id'];
	$allcomments = "SELECT * FROM `comment` where bug_id = $id" ;
    $comments = $base->query($allcomments);
    

if (isset($_POST['submit'])) {
        if (!empty($_POST['comment'])) {
              $descproduit = mysqli_real_escape_string($base,nl2br($_POST['comment']));
            $uid = mysqli_real_escape_string($base,nl2br($_POST['uid']));
                
              //echo $_POST['descproduit'].'<hr>'.$descproduit;
              //die();
            
                
              $addpro = "INSERT INTO comment(comment, bug_id,user_id) VALUES ('$descproduit', '$id','$uid' )";
              $rq = mysqli_query($base,$addpro);
         }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
      }
?>
<article> 
	<?php  if (isset($_SESSION['user'])) {
					if ($_SESSION['user']['user_type'] == "Triager") { ?> 
			<div class="paneloption">
				<a href="delete_produit.php?num=<?php echo $dataproduit['id'];?>" class="delete"><i class="ion ion-trash-a"></i></a>
				<a href="editproduit.php?num=<?php echo $dataproduit['id'];?>" class="edit"><i class="ion ion-edit"></i></a>
			</div>
			<?php } } ?>
    
	<h1><?php echo $dataproduit['title']; ?></h1>
	<div class="cont">
		<b>Time posted : </b><?php echo $dataproduit['ts_created']; ?><br><br>
		<b>Description :</b><br><p><?php echo $dataproduit['description']; ?></p>
	</div>
    
    
    <div class="cont">
        <b><h1>Solutions:</h1></b><br>
        <?php  while($comment = $comments->fetch_array()) {?>
            <b><?php echo $comment['comment']; ?></b> <br><?php echo $comment['ts_created']; ?><br><br>
        <?php }?>
    </div>
    <div class="cont">
        <b><h1>Add Comments:</h1></b><br>
        <form method="post" action="">
<article>
    <div class="cont">
		<p style="margin-left: -80px;"><textarea  name="comment" ></textarea></p>
	</div> 
    <input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ?>">
	<input type="submit" name="submit" value="post">
</article>
</form>
    </div>
</article>