<h2>Nuovo paziente</h2>
<div class="col-lg-4">
<?php
echo $this->Form->create('Paziente', array('type' => 'post', 'action' => 'crea'));

echo $this->Form->input('id');
echo $this->Form->input('cognome');
echo $this->Form->input('nome');
echo $this->Form->input('sesso');

echo "<div class=\"form-inline\">";
echo $this->Form->input('data_nascita');
echo "</div>";

echo "<br>";

echo $this->Form->input('luogo_nascita');
echo $this->Form->input('provincia_nascita');


echo $this->Form->input('codice_fiscale');
echo $this->Form->input('telefono');
echo $this->Form->input('telefono2');
echo $this->Form->input('email');
echo $this->Form->input('fax');
echo $this->Form->input('numero_cartella');
echo $this->Form->input('indirizzo_residenza');
echo $this->Form->input('citta_residenza');
echo $this->Form->input('provincia_residenza');
echo $this->Form->input('asl');
echo $this->Form->end('Crea scheda paziente');

?>
</div>
