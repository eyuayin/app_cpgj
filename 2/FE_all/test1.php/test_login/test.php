<?php
session_start();
    if (isset($_SESSION['valid_user'])){
print <<<EOT
<html>
<h1>welcome admin</h1>
</html>
EOT;
        }
        else
        echo "<h1>no session</h1>";
?>