<?php
    echo $this->Form->create('Anamnesievento', array('type' => 'post', 'action' => '', 'default' => false));
    echo $this->Form->input('paziente_id', array('type' => 'hidden', 'value' => $paziente_id));
    echo $this->Form->input('anamnesi_id', array('type' => 'hidden', 'value' => $paziente_id));
    
    
    echo $this->Form->input('id');
    echo "<div class=\"form-inline\">";
    echo $this->Form->input('data');
    echo "</div>";
    echo $this->Form->input('evento');
    echo $this->Form->input('descrizione');

    echo $this->Form->input('icd9cm');

    echo $this->Form->end();
    echo "<div id=\"eventocreaoutput\"></div>";
?>
