<?php
print_r($eventi);

echo "<dl class=\"dl-horizontal \">";
foreach ($eventi as $i => $e) {
    echo "<dt>" . $e['data'] . "</dt>";
    echo "<dd>" . $e['evento'];
    if (isset($e['descrizione'])) echo "<br>" . $e['descrizione'];
    if (isset($e['icd9cm'])) echo "<br>" . $e['icd9cm'];
    echo "</dd>";
}
echo "</dl>";
?>
