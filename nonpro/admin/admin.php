<?php
    if (isset($_SESSION['id'])) {
        echo '<p>Hello, ' .$_SESSION['username'].'</p>';
    }
?>
