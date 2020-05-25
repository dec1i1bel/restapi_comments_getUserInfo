<?php
include '../api/comments/read.php';
$arr = json_decode($arrMessages);
?>
<pre>
<?php print_r($arr); ?>
</pre>