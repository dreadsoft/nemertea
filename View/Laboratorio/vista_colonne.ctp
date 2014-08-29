<?php 
if ($dati['output'] === null) exit ("Non ci sono esami");
?>
<table class="table-bordered table-condensed table-striped analisi">
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
        array_unshift($info, "<b>$c</b>");
        
        echo $this->Html->tableCells($info);
    }
}

//print_r($dati)
?>
</table>