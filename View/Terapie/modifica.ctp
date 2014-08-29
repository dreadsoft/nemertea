<?php
echo $this->Form->create('Terapie', array('action' => 'salva', 'method' => 'post'));

echo $this->Form->input('id');
echo $this->Form->input('farmaco_nome', array('label' => 'Nome', 'disabled' => 'true'));
echo $this->Form->input('formulazione', array('disabled' => 'true'));
echo $this->Form->input('visita_id', array('type' => 'hidden'));
echo $this->Form->input('posologia');
echo $this->Form->input('note');
echo $this->Form->end();
?>