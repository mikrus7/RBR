<?php 

include "db.inc.php";

$usersApiUrl = "https://jsonplaceholder.typicode.com/users";
$postsApiUrl = "https://jsonplaceholder.typicode.com/posts";

$usersData = json_decode( file_get_contents($usersApiUrl), true);

foreach ($usersData as $user){
    $userAddress = "";
    $userCompany = "";
    foreach ($user['address'] as $address){
        $userAddress .= $address;
        foreach($address as $geo){
           $userAddress .= $geo;
        }
    }

    $userAddress = str_replace("Array", "", $userAddress);
    $userAddress = str_replace("", "\r\n", $userAddress);
 
    foreach ($user['company'] as $company){
        $userCompany .= $company;
    }
    $sql = "INSERT INTO users (id, usersName, usersUsername, usersEmail, usersAddress, usersPhone, usersWebsite, usersCompany) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit(mysqli_stmt_errno($stmt));
    }else{
        mysqli_stmt_bind_param($stmt, "ssssssss", $user['id'],$user['name'],$user['username'],$user['email'],$userAddress,$user['phone'],$user['website'],$userCompany);
        mysqli_stmt_execute($stmt);
    } 
}

$postsData =  json_decode( file_get_contents($postsApiUrl), true);

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

mysqli_stmt_close($stmt);
mysqli_close($conn); 
include("post.inc.php");
header('Location: /RBR/index.php');