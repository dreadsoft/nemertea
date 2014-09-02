<?php
class Terapie extends AppModel {
    public function farmaciVisita ($visita_id)
    {
        $terapie = $this->findAllByVisita_id($visita_id);
        return($terapie);
    }
}
?>