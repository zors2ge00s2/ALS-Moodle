<?php
   var_dump($_POST);
   var_dump($_REQUEST);
    $file = "/var/www/html/lib/dest/assign_destinations.txt";
    if(isset($_POST))
    {
        $postedHTML = $_POST['html']; // You want to make this more secure!
        file_put_contents($file, $postedHTML);
    }

?>
<form action="" method="post">
    <?php
    $content = file_get_contents($file);
    echo "<textarea name='html'>" . htmlspecialchars($content) . "</textarea>";
    ?>
    <input type="submit" value="Edit page" />
</form>
