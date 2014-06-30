<h2>Visite</h2>
<?php
echo "<ul class=\"sezioni-etichette\">";
foreach ($visite as $v) {

    $data_visita = $this->Time->format($v['Visita']['data_visita'], "%d/%m/%Y");
    echo "<li><button class=\"btn btn-primary\" onclick=\"apri_scheda_visita({$v['Visita']['id']})\">$data_visita</button><br>";
    echo "<p>{$v['Visita']['diario_clinico']}</p><footer>{$v['Visita']['effettuata_da']}</footer><li>";
    
}
echo "</ul>";
?>

<script>
function apri_scheda_visita(id) 
{
    window.location.href = '/visite/apri/' + id;
}
</script>


