
<?php
$start=strtotime("01 January 2010");
$now=strtotime(date("d F Y"));

while($now>=$start)
{
    echo "<option value=\"$now\">" . date('Y-m-d H:i:s', $now) . "</option>\n";

    $now=$now-(60*60*24*(365/12));
}
?>