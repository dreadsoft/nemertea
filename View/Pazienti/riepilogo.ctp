<h2>Riepilogo paziente</h2>

<?php
foreach ($paz['Visita'] as $v) {
    $data_visita = $this->Time->format($v['data_visita'], "%d/%m/%Y");
    echo $data_visita ."<br>\n";
}
?>



<pre>
<?php
print_r($paz['Visita']);
?>
</pre>