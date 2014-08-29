<table class="table table-bordered table-striped">
<?php
echo $this->Html->tableHeaders(array('Nome', 'Formulazione', 'Posologia', 'Note', 'Azioni'));


foreach ($terapie as $i => $ter) {
    $terapia_id = $ter['Terapie']['id'];
    unset($ter['Terapie']['id']);
    unset($ter['Terapie']['visita_id']);
    unset($ter['Terapie']['farmaco_id']);
    $azioni  = "<button class=\"btn btn-warning btn-xs\" title=\"Modifica\" onclick=\"modificaTerapia('$terapia_id')\"><i class=\"fa fa-pencil\"></i></button>&nbsp;";
    $azioni .= "<button class=\"btn btn-danger btn-xs\"  title=\"Elimina\"  onclick=\"eliminaTerapia('$terapia_id')\"><i class=\"fa fa-times\"></i></button>";
    $ter['Terapie'][] = $azioni;
    echo $this->Html->tableCells($ter['Terapie']);
    
}

?>
</table>