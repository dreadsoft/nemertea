<?php
App::uses('HtmlHelper', 'View/Helper');
 class BootstrapHelper extends HtmlHelper {
     
     public function panel ($title, $body, $type='primary', $body_id = null)
     {
         $id = '';
         if ($body_id != null) $id = " id='{$body_id}'";
         
         $p  = "<div class=\"panel panel-$type\">";
         $p .= '<div class="panel-heading">';
         $p .= '<h3 class="panel-title">' . $title . '</h3>';
         $p .= '</div>';
         $p .= "<div class=\"panel-body\"{$id}>" . $body . '</div>';
         $p .= '</div>';
         
         return $p;
     }
 }

?>
