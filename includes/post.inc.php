<?php 

include "db.inc.php";

$sql = "DELETE FROM current";
mysqli_query($conn, $sql);

for($counter = 1; $counter < 11; $counter++){
    $sql = "SELECT * FROM `users` INNER JOIN `posts` ON users.id = posts.postsUserId WHERE users.id = '$counter' AND posts.postsUsed = 0 LIMIT 1";
    $results = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($results) >0){
       
        while($row = mysqli_fetch_array($results)){
          
           $sql = "UPDATE posts SET postsUsed = 1 WHERE postsTitle = '".$row['postsTitle']."';";
           $sql2 = "INSERT INTO current (currentPostsId, currentUsersId) VALUES ('".$row['postsId']."','".$row['postsUserId']."');";
            
        }
        
    $results = mysqli_query($conn, $sql);
    $results = mysqli_query($conn, $sql2); 
    } else{
        $sql = "UPDATE posts SET postsUsed = 0 WHERE postsUsed = 1";
        mysqli_query($conn, $sql);
        header("Location: /RBR/includes/post.inc.php");
    }

}

//crontab -e 0 0 * * * php [link directory]