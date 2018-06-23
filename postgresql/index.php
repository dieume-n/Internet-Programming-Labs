<h1>Tables in information_schema</h1>

<?php

$dbh = new PDO("pgsql:host=127.0.0.1;dbname=postgres;", '', '', array(PDO::ATTR_PERSISTENT => true));

$sql = 'SELECT table_schema,table_name FROM information_schema.tables ORDER BY table_schema,table_name;';
foreach ($dbh->query($sql) as $row)
{
	?>
	<?= $row['table_name']; ?><br>
	<?php
}