<?php 
//polaczenia z DB
include "db.inc.php";
// $ zapisuje link do API 
$usersApiUrl = "https://jsonplaceholder.typicode.com/users";
$postsApiUrl = "https://jsonplaceholder.typicode.com/posts";
// $ zmienia dane z API na czytelne []
$usersData = json_decode( file_get_contents($usersApiUrl), true);
// czyta [] linia po lini 
foreach ($usersData as $user){
    $userAddress = "";
    $userCompany = "";
    //otwiera multidimensional [] do uzycia na pozniej
    foreach ($user['address'] as $address){
        $userAddress .= $address;
        foreach($address as $geo){
           $userAddress .= $geo;
        }
    }
    // kasuje z danych multidimensional []
    $userAddress = str_replace("Array", "", $userAddress);
    
    
    foreach ($user['company'] as $company){
        $userCompany .= $company;
    }
    // wrzuca wszystkie dane uzytkownikow do DB
    $sql = "INSERT INTO users (id, usersName, usersUsername, usersEmail, usersAddress, usersPhone, usersWebsite, usersCompany) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit(mysqli_stmt_errno($stmt));
    }else{
        mysqli_stmt_bind_param($stmt, "ssssssss", $user['id'],$user['name'],$user['username'],$user['email'],$userAddress,$user['phone'],$user['website'],$userCompany);
        mysqli_stmt_execute($stmt);
    } 
}
// $ zmienia dane z API na czytelne []
$postsData =  json_decode( file_get_contents($postsApiUrl), true);
  // wrzuca wszystkie dane postow do DB
foreach ($postsData as $post){
    $sql = "INSERT INTO posts (postsId, postsUserId, postsTitle, postsBody) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit(mysqli_stmt_errno($stmt));
    }else{
        mysqli_stmt_bind_param($stmt, "ssss", $post['id'],$post['userId'],$post['title'],$post['body']);
        mysqli_stmt_execute($stmt);
    }
}
// zamyka polaczenie z DB dla bezpieczenstwa
mysqli_stmt_close($stmt);
mysqli_close($conn); 
//otwarza poraz pierwszy script pokazujaca posty w index
include("post.inc.php");
header('Location: /RBR/index.php');