<?php
App::uses('HtmlHelper', 'View/Helper');
 class BootstrapHelper extends HtmlHelper {
     
     public function panel ($title, $body, $type='primary')
     {
         $p  = "<div class=\"panel panel-$type\">";
         $p .= '<div class="panel-heading">';
         $p .= '<h3 class="panel-title">' . $title . '</h3>';
         $p .= '</div>';
         $p .= '<div class="panel-body">' . $body . '</div>';
         $p .= '</div>';
         
         return $p;
     }
 }

?>
