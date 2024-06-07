<?php 
require_once 'parts/header.php';
?>

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
        $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
        // prepare request
        $sortOption = $_POST['sort'] ?? 'desc';

        if  ($sortOption === 'asc') {
            $request = $connectDatabase->prepare("SELECT * FROM review ORDER BY created_at ASC");
        } else if ($sortOption === 'desc') {
            $request = $connectDatabase->prepare("SELECT * FROM review ORDER BY created_at DESC");
        } else if ($sortOption === 'note_asc') {
            $request = $connectDatabase->prepare("SELECT * FROM review ORDER BY note ASC");
        } else if ($sortOption === 'note_desc') {
            $request = $connectDatabase->prepare("SELECT * FROM review ORDER BY note DESC");
        } else {
            $request = $connectDatabase->prepare("SELECT * FROM review ORDER BY created_at DESC");
        }

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
