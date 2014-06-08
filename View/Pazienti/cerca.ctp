<h2>Pazienti</h2>

<?php

/**
echo "<pre>";
print_r($pazienti);
echo "</pre>";
**/

echo "<table class=\"table table-striped table-bordered table-hover\">";


echo $this->Html->tableHeaders( array(
		"Cognome", 
		"Nome", 
		"Data di nascita", 
		"Telefono",
		"Azioni"
		)
	);


foreach ($pazienti as $pz) {
	$pulsanti = "<a title='riepilogo' href=\"/pazienti/riepilogo/" . $pz['Paziente']['id'] ."\"><i class=\"fa fa-home \"></i></a>";
        $pulsanti .= " <a title='anamnesi' href=\"/anamnesi/paziente/" . $pz['Paziente']['id'] ."\"><i class=\"fa fa-th-list \"></i></a>";

	$inforow = array(
		$pz['Paziente']['cognome'],
		$pz['Paziente']['nome'], 
		$pz['Paziente']['data_nascita'],
		$pz['Paziente']['telefono'],
		$pulsanti
		);
		
	echo $this->Html->tableCells($inforow);
}

echo "</table>";
?>

