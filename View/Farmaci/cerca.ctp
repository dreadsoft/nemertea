<table class="table-bordered table-condensed table-striped">

<?php
echo $this->Html->tableHeaders(array("Nome", "Formulazione", "+"), array('class' => 'text-center'));
foreach ($elenco as $nome => $formulazioni) 
{
    foreach ($formulazioni as $for => $id) {
        $aggiungiHtml = "<button class=\"btn btn-sm fa fa-plus-circle\" onclick=\"aggiungiFarmaco('$id')\"></button>";
        echo $this->Html->tableCells(array($nome, $for, $aggiungiHtml));
    }
    
}
?>
</table>

<script>
    function aggiungiFarmaco (id) 
    {
        window.location = "/farmaci/aggiungiavisita/" + id + "#areaTerapia";
    }
</script>