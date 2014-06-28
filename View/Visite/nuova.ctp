<h2>Nuova visita</h2>

<?php

echo $this->Form->create('Visita', array('type' => 'post', 'action' => 'modifica'));
echo $this->Form->input('id', array("readonly" => 'true'));

echo $this->Form->input('paziente_id', array("default" => $paziente_id, "type" => 'hidden'));
    echo "<div class=\"form-inline\">";
    echo $this->Form->input('data_visita');
    echo "</div>";
echo $this->Form->input('tipovisita_id', array("label" => "Tipo visita", "options" => $tipovisita));
echo $this->Form->input('effettuata_da');

echo "<div class=\"text-right\">";
echo $this->Form->end('Salva visita');
echo "</div>";
?>