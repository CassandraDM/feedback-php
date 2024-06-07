<?php
session_start();


$name_establishment = $_POST['name'];
$email_establishment = $_POST['email'];
$description_establishment = $_POST['description'];
$note_establishment = 0 ;



if(empty($name_establishment)) {
    $_SESSION['error'] = "Name field is required.";
    header("Location: ../establishment-form.php");
    die();  
}

if(empty($email_establishment)) {
    $_SESSION['error'] = "Email field is required.";
    header("Location: ../establishment-form.php");
    die(); 
}

if (!filter_var($email_establishment, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error']= "Invalid email format";
    header("Location: ../establishment-form.php");
    die();
  }


if(empty($description_establishment)) {
    $_SESSION['error'] = "Description field is required.";
    header("Location: ../establishment-form.php");
    die();  
}

if( !empty($name_establishment) && !empty($email_establishment) && !empty($description_establishment)){
    $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
    $request = $connectDatabase->prepare("INSERT INTO establishment (name, email, description, note) VALUES (:name, :email, :description, :note)");
    $request->bindParam(':name', $name_establishment);
    $request->bindParam(':email', $email_establishment);
    $request->bindParam(':description', $description_establishment);
    $request->bindParam(':note', $note_establishment);
    $request->execute();
    
    header('Location: ../establishment.php');
}



?>