<?php
foreach($ultime_visite as $v) {
    echo "<li>";
    echo "<a href=\"/visite/apri/{$v['Visita']['id']}\">";
    $data_visita = $this->Time->format($v['Visita']['data_visita'], "%d/%m/%Y");
    echo $data_visita;
    echo "</a>";
    echo "</li>";
}
?>
<li class='divider'></li>
<li>
    <a class='text-center' href='/visite/elenco/<?php echo $paziente_id; ?>'>Elenco completo</a>
</li>