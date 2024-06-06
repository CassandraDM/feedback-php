<?php 
require_once 'parts/header.php';
?>

    <a href="feedback-form.php">Add a feedback</a>

    <div class="feedback-list">
    <?php
        $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
        // prepare request
        $request = $connectDatabase->prepare("SELECT * FROM review");
        // execute request
        $request->execute();

        // fetch All data from table posts
        $reviews = $request->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($reviews as $review):

    ?>

    <div class="feedback">
            <div class="feedback-header">        
                <h5><?php echo htmlspecialchars($review['note']); ?> stars</h5>
                <h3><?php echo htmlspecialchars($review['name']); ?></h3>
            </div>
            <div class="feedback-content">
                <p><?php echo htmlspecialchars($review['email']); ?></p>
                <p><?php echo htmlspecialchars($review['message']); ?></p>
            </div>
    </div>

    <?php endforeach ?>

<?php
require_once 'parts/footer.php';
?>