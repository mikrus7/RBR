<?php

require "includes/db.inc.php";

?>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>
<body>

<table class="table table-bordered border-primary">
    <thead>
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Content</th>
        </tr>

    </thead>  
    <tbody>
    <?php
        $sql = "SELECT * FROM current INNER JOIN posts ON current.currentPostsId = posts.postsId INNER JOIN users ON current.currentUsersId = users.id";
        $results = mysqli_query($conn,$sql);
        if(mysqli_num_rows($results) >0){
            while($row = mysqli_fetch_array($results)){
                ?>
                <tr>
                <td><?php echo $row["usersName"];?></td>
                <td><?php echo $row["postsTitle"];?></td>
                <td><?php echo $row["postsBody"];?></td>
                </tr> <?php 
        
        }
    } else{
        header('Location: /RBR/includes/api.inc.php');
    }
        ?> 
    </tbody>
</table>

</body>
<footer>

</footer>
</html>