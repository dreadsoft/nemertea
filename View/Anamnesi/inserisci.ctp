<h2>Inserimento anamnesi</h2>

<?php

echo $this->Form->create('Anamnesi', array('type' => 'post', 'action' => 'modifica'));


echo $this->Form->input('id', array("default" => $paziente_id, "readonly" => 'true'));
echo $this->Form->input('paziente_id', array("default" => $paziente_id, "type" => 'hidden'));


echo $this->Form->input('diagnosi_principale', array('options' => $diagnosi_principale));

echo $this->Form->input('familiare');
echo $this->Form->input('fisiologica');
echo $this->Form->input('fumo', array("options" => array("", "S", "N", "EX")));
echo $this->Form->input('fumo_sigarette');
echo $this->Form->input('fumo_anni');
echo $this->Form->input('fumo_packyear', array("readonly" => 'true'));
echo $this->Form->input('alcol_unita');
echo $this->Form->input('alvo');
echo $this->Form->input('diuresi');
echo $this->Form->input('allergie');

echo $this->Form->end('Salva anamnesi');
?>
</div>
