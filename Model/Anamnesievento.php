<?php
class Anamnesievento extends AppModel {
        public $useTable = 'anamnesi_eventi';
        public $belongsTo = array('Anamnesi', 'Paziente');
       
}
