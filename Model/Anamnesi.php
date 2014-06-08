<?php
class Anamnesi extends AppModel {
	public $belongsTo = 'Paziente';
        public $hasMany = array("Anamnesievento" => array('order' => 'Anamnesievento.data ASC'));
}
