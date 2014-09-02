<?php

            
foreach ($destinazione as $tab => $info) {
    if (count($info) == 0) continue;
    $item   = "<li><a href=\"javascript:modificaEsameDiLaboratorio('$tab', '{$info[0]['id']}');\">";
    $item  .= "<div><i class='fa fa-fw fa-flask'></i>" . $indagini_laboratorio[$tab];
    $item  .= "<span class=\"pull-right\">{$info[0]['data']}</span></div>";
    $item  .= "</a></li>";
    echo $item;
}

?>





