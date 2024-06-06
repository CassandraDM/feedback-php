<?php
session_start();

$note_feedback = $_POST['note'];
$name_feedback = $_POST['name'];
$email_feedback = $_POST['email'];
$message_feedback = $_POST['message'];


if(empty($note_feedback)) {
    $_SESSION['error'] = "Note field is required.";
    header("Location: ../feedback-form.php");
    die();  
}

if($note_feedback < 0 || $note_feedback > 5) {
    $_SESSION['error'] = "Note must be between 0 and 5.";
    header("Location: ../feedback-form.php");
    die();  
}

if(empty($name_feedback)) {
    $_SESSION['error'] = "Name field is required.";
    header("Location: ../feedback-form.php");
    die();  
}

if(empty($email_feedback)) {
    $_SESSION['error'] = "Email field is required.";
    header("Location: ../feedback-form.php");
    die(); 
}

if (!filter_var($email_feedback, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error']= "Invalid email format";
    header("Location: ../feedback-form.php");
    die();
  }


if(empty($message_feedback)) {
    $_SESSION['error'] = "Message field is required.";
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