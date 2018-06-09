<?php
session_start();
?>
<html>
<body>

<?php
session_unset(); 
session_destroy();
    header("Location: http://localhost/webbnix/phpfolder/index.php");
?>

</body>
</html>