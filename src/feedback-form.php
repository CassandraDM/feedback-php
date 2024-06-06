<?php 


require_once 'parts/header.php';

?>

    <form action="scripts/feedback-form-script.php" class="feedback-form" method="POST">
        <input type="text" name="note" placeholder="Enter your note from 0 to 5">
        <input type="text" name="name" placeholder="Enter your name">
        <input type="text" name="email" placeholder="Enter your email address">
        <textarea name="message" id="" placeholder="Write your feedback"></textarea>
        <input type="submit" value="Submit">
    </form>


<?php
if(isset($_SESSION['error'])) {
    echo '<div class="error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']); 
}
require_once 'parts/footer.php';
?>