<?php

/*
# Datenbank: `dc_php`

CREATE TABLE kaugummisorten (
  id int(11) NOT NULL auto_increment,
  name text NOT NULL,
  geschmack int(11) NOT NULL default '0',
  farbe text NOT NULL,
  preis varchar(15) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;
*/

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("dc_php");

if ($mode == "edit") {
    if ($id) {
        $res = mysql_query("SELECT * FROM kaugummisorten
            WHERE id = ".$id);
        $d = mysql_fetch_array($res);
    }
?><form method="post" action="./">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table border="0" cellpadding="2" cellspacing="1" width="300">
<tr><td>Bearbeiten</td></tr>
<tr><td>name:</td><td><input type="text" name="name" value="<?php echo $d[name]; ?>"></td></tr>
<tr><td>geschmack:</td><td><select name=geschmack><option value=0>Bitte w�hlen!</option><?php
    if ($d[geschmack] == 1)
         echo "<opton value=\"1\" selected>S��</option>";
    else echo "<opton value=\"1\">S��</option>";
    if ($d[geschmack] == 2)
         echo "<opton value=\"2\" selected>Sauer</option>";
    else echo "<opton value=\"2\">Sauer</option>";
    if ($d[geschmack] != 1 && $d[geschmack] != 2)
         echo "<opton value=\"3\" selected>Anders</option>";
    else echo "<opton value=\"3\">Anders</option>";
    
?></td></tr>
<tr><td>farbe:</td><td><input type="text" name="farbe" value="<?php echo $d[farbe]; ?>"></td></tr>
<tr><td>preis:</td><td><input type="text" name="preis" value="<?php echo $d[preis]; ?>"></td></tr>
<tr><td><input type="submit"></td></tr>
</table>
</form><?php
} elseif ($mode == "save") {
    mysql_query("UPDATE kaugummisorten SET
        name = \"$name\", geschmack=\"$geschmack\", farbe=\"$farbe\",
        preis=\"preis\"
        WHERE id = $id");
    echo "gespeichert!";
} else {
    $res = mysql_query("SELECT * FROM kaugummisorten");
    $sorten = array();
    while ($d = mysql_fetch_array($res))
        $sorten = array_merge($sorten, array($d));
    $i = 0;
?><table border="0" cellpadding="2" cellspacing="1" width="300"><?php
    foreach($sorten AS $v) {
        $preis = str_replace(".", ",", $v[preis]);
        echo "<tr><td>$i</td><td>$v[id]</td><td>$v[name]</td><td>";
        if ($v[geschmack] == 1) echo "S��";
        elseif ($v[geschmack] == 2) echo "Sauer";
        else echo "Anders";
        echo "</td><td>$v[farbe]</td><td>$preis</td><td><a href=\"./?id=$v[id]&mode=edit\">Bearbeiten</a></tr>";
    }
?></table><a href="?mode=edit">hinzuf�gen</a><?php
}

mysql_close($conn);

?>