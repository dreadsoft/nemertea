<?php
$paziente_id = $this->Session->read("Paziente.id");

$ultime_visite = $this->RequestAction('/visite/ultime/' . $paziente_id);

print_r($ultime_visite);


?>