<?php 
require_once 'parts/header.php';
?>

    <a href="establishment-form.php">Add an establishment</a>

    <form method="post" action="">
    <select name="sort" id="sort">
        <option value="note_asc">Sort by ascending (note)</option>
        <option value="note_desc">Sort by descending (note)</option>
    </select>
    <input type="submit" value="Sort">
    </form>

    <div class="establishment-list">
    <?php
        $connectDatabase = new PDO("mysql:host=db;dbname=feedback","root", "admin");
        // prepare request
        $sortOption = $_POST['sort'] ?? 'desc';

        if ($sortOption === 'note_asc') {
            $request = $connectDatabase->prepare("SELECT * FROM establishment ORDER BY note ASC");
        } else if ($sortOption === 'note_desc') {
            $request = $connectDatabase->prepare("SELECT * FROM establishment ORDER BY note DESC");
        } else {
            $request = $connectDatabase->prepare("SELECT * FROM establishment ORDER BY note DESC");
        }

        // execute request
        $request->execute();

        // fetch All data from table posts
        $establishments = $request->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($establishments as $establishment):

    ?>

    <div class="establishment">
            <div class="establishment-header">        
                <h1><?php echo htmlspecialchars($establishment['name']); ?></h1>
                <h5><?php echo htmlspecialchars($establishment['note']); ?> stars</h5>
                
            </div>
            <div class="establishment-content">
                <p><?php echo htmlspecialchars($establishment['email']); ?></p>
                <p><?php echo htmlspecialchars($establishment['description']); ?></p>
            </div>
            <a href="establishment-single.php?id=<?php echo $establishment['id']?>" >View More</a>
    </div>

    <?php endforeach ?>

<?php
require_once 'parts/footer.php';
?>
