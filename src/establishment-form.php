<?php 

require_once 'parts/header.php';

?>

    <form action="scripts/establishment-form-script.php" class="feedback-form" method="POST">
        <input type="text" name="name" placeholder="Enter your establishment name">
        <input type="text" name="email" placeholder="Enter your email address">
        <textarea name="description" id="" placeholder="Write your description"></textarea>
        <input type="submit" value="Submit">
    </form>


<?php
if(isset($_SESSION['error'])) {
    echo '<div class="error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']); 
}
require_once 'parts/footer.php';
?>