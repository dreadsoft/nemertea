<?php 
if ($dati['output'] === null) exit ("Non ci sono esami");
?>
<table class="table-bordered table-condensed table-striped table-hover analisi">
<?php 

/*
 * Creo gli header con le date
 */
$dateheader = array_keys($dati['date']);
foreach ($dateheader as $i => $d) {
    $dateheader[$i] = $this->Time->format('d-m', $d) . "<br>" . $this->Time->format('Y', $d);
}

array_unshift($dateheader, "&nbsp;");
echo $this->Html->tableHeaders($dateheader);

/*
 * Creo le celle con gli esami
 */
foreach ($dati['output'] as $tab => $campi) {
    foreach ($campi as $c => $info) {
        // Aggiungo la cella con il nome dell'esame
        array_unshift($info, "$c");
        echo $this->Html->tableCells($info);
    }
}

//print_r($dati)
?>
</table>

<script>
$('#esamiLaboratorioVisita').html();
<?php
foreach ($dati['lista_esami'] as $tab => $esami) {
    foreach ($esami as $id => $data) {
        $li  =  "<li><a href=\"#\">{$indagini_laboratorio[$tab]}";
        
        $data = CakeTime::format($data, '%d-%m-%Y');
        
        $li .=  "<span class=\"pull-right\"><i class=\"fa fa-fw fa-ellipsis-v\"></i>$data&nbsp;<i class=\"fa fa-fw fa-ellipsis-v\"></i>";
        $li .=  "<button onClick=\"modificaEsameDiLaboratorio(\'$tab\', \'$id\');\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-fw fa-pencil\"></i></button>&nbsp;&nbsp;";
        $li .=  "<button onClick=\"eliminaEsameDiLaboratorio(\'$tab\', \'$id\');\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-fw fa-times\"></i></button>";
        $li .=  "</span>";
        $li .= "</a></li>";
        echo "$('#esamiLaboratorioVisita').append('$li');";
    }
}
?>
</script>