<?php
session_start();
$_SESSION['auth'] = false;
session_destroy();
?>

<html>
<head>
<script language="Javascript" type="text/javascript">
parent.location.href="index.php?val=loggedout";
</script>
</head>
</body>
</html>