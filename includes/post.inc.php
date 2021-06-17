<?php 
//polaczenia z DB
include "db.inc.php";
//kasuje posty raz dziennie
$sql = "DELETE FROM current";
mysqli_query($conn, $sql);
//ustawiony loop pokazuje 10 uzytkownikow
for($counter = 1; $counter < 11; $counter++){
    //sciaga 1 post do kazdego uzytkownika
    $sql = "SELECT * FROM `users` INNER JOIN `posts` ON users.id = posts.postsUserId WHERE users.id = '$counter' AND posts.postsUsed = 0 LIMIT 1";
    $results = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($results) >0){
       
        while($row = mysqli_fetch_array($results)){
          //dla postow uzywanych w index dodaje dane do tabelki current i aktualizuje tabele post
           $sql = "UPDATE posts SET postsUsed = 1 WHERE postsTitle = '".$row['postsTitle']."';";
           $sql2 = "INSERT INTO current (currentPostsId, currentUsersId) VALUES ('".$row['postsId']."','".$row['postsUserId']."');";
            
        }
        
    $results = mysqli_query($conn, $sql);
    $results = mysqli_query($conn, $sql2); 
    } else{
        // jesli script uzyla wszystkie posts 1 raz, resetuje tabelke i otwiera scrypt ponownie
        $sql = "UPDATE posts SET postsUsed = 0 WHERE postsUsed = 1";
        mysqli_query($conn, $sql);
        header("Location: /RBR/includes/post.inc.php");
    }

}
//cykliczny script raz dziennie 
//crontab -e 
//i (INSERT)
//0 0 * * * php [link directory]
//esc
//:wq