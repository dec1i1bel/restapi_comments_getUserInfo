<?php
include '../api/message/read.php';
$arr = json_decode($arrMessages);
?>
<pre>
<?php print_r($arr); ?>
</pre>