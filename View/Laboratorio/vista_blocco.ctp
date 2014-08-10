<?php 

/**
 * Pulizia dei dati emogasanalisi (per visualizzazione più sintetica)
 */
if ($tabella == 'emogasanalisi') {

    foreach ($pretable as $i => $ega) {

        $pretable[$i] = array (
            'Data'      => $this->Time->format("d-m-Y", $ega['data']),
            'pO2'       => $ega['po2'],
            'pCO2'      => $ega['pco2'],
            'pH'        => $ega['ph'],
            'hCO3'      => $ega['hco3'],
            'sO2'       => $ega['so2'],
            'FiO2'      => $ega['fio2'],
            'Dettagli'  => "<a href=\"javascript:modificaEsameDiLaboratorio('$tabella', {$ega['id']})\"><i class=\"fa fa-search\"></i></button>"
        );
    }
}

// print_r($pretable) ;
?>
    
<?php
if (is_array($pretable) && count($pretable) > 0) {
    $contenuto  = "<table class=\"table table-condensed table-bordered\">";
    $contenuto .= $this->Html->tableHeaders(array_keys($pretable[0]));
    $contenuto .= $this->Html->tableCells($pretable);
    $contenuto .= "</table>";
    echo  $this->BS->panel(ucfirst($tabella), $contenuto, 'primary', $tabella);
}


?>
