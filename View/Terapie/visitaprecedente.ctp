<?php
if (count($terapie > 0)) {
    foreach ($terapie as $t) {
        echo "<li>";
            echo "<a>" . $t['Terapie']['farmaco_nome'] . " <i class=\"fa fa-circle\"></i> <em>" . $t['Terapie']['posologia'] . "</em></a>";
        echo "</li>";
        echo "<li class=\"divider\"></li>";

    }
}
else {
    echo "<li><a>Non ci sono terapie precedenti</a></li>";
}

if($visita_precedente !== null) echo "<li><a href=\"/visite/apri/{$visita_precedente}\">Visita precedente</a></li>";
?>
