<h2>Riepilogo paziente</h2>

<h3>Informazioni anagrafiche</h3>

<?php
$pazinfo = $paz['Paziente'];
?>
<dl class='dl-horizontal'>
    <dt>Cognome</dt>
    <dd><?php echo $pazinfo['cognome']?>&nbsp;</dd>
     <dt>Nome</dt>
    <dd><?php echo $pazinfo['nome']?>&nbsp;</dd>   
    <dt>Sesso</dt>
    <dd><?php echo $pazinfo['sesso']?>&nbsp;</dd>
    <dt>Data di nascita</dt>
    <dd><?php echo $pazinfo['data_nascita']?>&nbsp;</dd>
    <dt>Luogo di nascita</dt>
    <dd><?php echo $pazinfo['luogo_nascita'] . " (" . $pazinfo['provincia_nascita'] . ")"; ?>&nbsp;</dd>
    <dt>Codice fiscale</dt>
    <dd><?php echo $pazinfo['codice_fiscale']?>&nbsp;</dd>
    <dt>Telefono</dt>
    <dd><?php echo "<a href=\"tel:{$pazinfo['telefono']}\">{$pazinfo['telefono']}</a>";?>&nbsp;</dd>
    <dt>Telefono secondario</dt>
    <dd><?php echo $pazinfo['telefono2']?> &nbsp;</dd>
    <dt>email</dt>
    <dd><?php echo "<a href=\"mailto:{$pazinfo['email']}\">{$pazinfo['email']}</a>"?>&nbsp;</dd>
    <dt>Fax</dt>
    <dd><?php echo $pazinfo['fax']?>&nbsp;</dd>
    <dt>Cartella cartacea</dt>
    <dd><?php echo $pazinfo['numero_cartella']?>&nbsp;</dd>
    
    <?php
        
        $indirizzo = $pazinfo['indirizzo_residenza']. " - ";
        $indirizzo .= $pazinfo['citta_residenza'] . " (" . $pazinfo['provincia_residenza'] . ")";
        
        $indirizzo = "<a href=\"http://maps.google.com?q=$indirizzo\">$indirizzo</a>";
    ?>         
            
    <dt>Indirizzo</dt>
    
    <dd><?php echo $indirizzo; ?>&nbsp;</dd>

    <dt>ASL</dt>
    <dd><?php echo $pazinfo['asl']?>&nbsp;</dd>

    <dt>Medico curante</dt>
    <dd><?php echo $pazinfo['nome_mmg']?>&nbsp;</dd>

    <dt>Telefono medico</dt>
    <dd><?php echo $pazinfo['tel_mmg']?>&nbsp;</dd>

</dl>



<h3>Visite</h3>

<?php
echo "<ul class=\"sezioni-etichette\">";
foreach ($paz['Visita'] as $v) {
    
    
    
    
    $data_visita = $this->Time->format($v['data_visita'], "%d/%m/%Y");
    echo "<li><button class=\"btn btn-primary\" onclick=\"apri_scheda_visita({$v['id']})\">$data_visita</button><br>";
    echo "<p>{$v['diario_clinico']}</p><footer>{$v['effettuata_da']}</footer><li>";
    
}
echo "</ul>";
?>



<script>
function apri_scheda_visita(id) 
{
    window.location.href = '/visite/apri/' + id;
}
</script>