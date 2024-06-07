<?php 
require_once 'parts/header.php';
?>



<?php
        $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
        // prepare request


        $request = $connectDatabase->prepare("SELECT * FROM establishment WHERE id = :id");

        $request->bindParam(':id', $_GET['id']);
        // execute request
        $request->execute();

        // fetch All data from table posts
        $establishment = $request->fetch(PDO::FETCH_ASSOC);

    ?>


<div class="establishment-single">
    <div class="establishment-header">        
        <h1><?php echo htmlspecialchars($establishment['name']); ?></h1>
        <h5><?php echo htmlspecialchars($establishment['note']); ?> stars</h5>
                
    </div>
    <div class="establishment-content">
        <p><?php echo htmlspecialchars($establishment['email']); ?></p>
        <p><?php echo htmlspecialchars($establishment['description']); ?></p>
    </div>
</div>

<a href="feedback-form.php?id=<?php echo $establishment['id']?>">Add a feedback</a>

<form method="post" action="">
    <select name="sort" id="sort">
        <option value="asc">Sort by ascending (date)</option>
        <option value="desc">Sort by descending (date)</option>
        <option value="note_asc">Sort by ascending (note)</option>
        <option value="note_desc">Sort by descending (note)</option>
    </select>
    <input type="submit" value="Sort">
    </form>

    <div class="feedback-list">
    <?php

        $establishment_id = $_GET['id'];

        $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
        // prepare request
        $sortOption = $_POST['sort'] ?? 'desc';

        if  ($sortOption === 'asc') {
            $request = $connectDatabase->prepare("SELECT * FROM review WHERE establishment_id = :establishment_id ORDER BY created_at ASC");
        } else if ($sortOption === 'desc') {
            $request = $connectDatabase->prepare("SELECT * FROM review WHERE establishment_id = :establishment_id ORDER BY created_at DESC");
        } else if ($sortOption === 'note_asc') {
            $request = $connectDatabase->prepare("SELECT * FROM review WHERE establishment_id = :establishment_id ORDER BY note ASC");
        } else if ($sortOption === 'note_desc') {
            $request = $connectDatabase->prepare("SELECT * FROM review WHERE establishment_id = :establishment_id ORDER BY note DESC");
        } else {
            $request = $connectDatabase->prepare("SELECT * FROM review WHERE establishment_id = :establishment_id ORDER BY created_at DESC");
        }

        $request->bindParam(':establishment_id', $establishment_id, PDO::PARAM_INT);
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
                <p>Posted on: <?php echo htmlspecialchars($review['created_at']); ?></p>
            </div>
    </div>

    <?php endforeach ?>

<?php
require_once 'parts/footer.php';
?>