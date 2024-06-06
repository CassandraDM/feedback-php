<?php

$note_feedback = $_POST['note'];
$name_feedback = $_POST['name'];
$email_feedback = $_POST['email'];
$message_feedback = $_POST['message'];


if(empty($note_feedback)) {
    header("Location: ../feedback-form.php");
    die(); 
}

if(empty($name_feedback)) {
    header("Location: ../feedback-form.php");
    die(); 
}

if(empty($email_feedback)) {
    header("Location: ../feedback-form.php");
    die(); 
}

if(empty($message_feedback)) {
    header("Location: ../feedback-form.php");
    die(); 
}

if(!empty($note_feedback) && !empty($name_feedback) && !empty($email_feedback) && !empty($message_feedback)){
    $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
    $request = $connectDatabase->prepare("INSERT INTO review (note, name, email, message) VALUES (:note, :name, :email, :message)");
    $request->bindParam(':note', $note_feedback);
    $request->bindParam(':name', $name_feedback);
    $request->bindParam(':email', $email_feedback);
    $request->bindParam(':message', $message_feedback);
    $request->execute();
    
    header('Location: ../index.php');
}



?>