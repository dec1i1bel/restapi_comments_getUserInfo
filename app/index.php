<?php
include '../api/config/connectDb.php';
$conn = new ConnectDb();
$conn->getConnection();

?>
<pre>
  <?php print_r($conn); ?>
</pre>