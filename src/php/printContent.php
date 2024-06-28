<?php
function printContent($array){
    if($array == []){
        echo '<h1 class="e404__text">No hay contenido para mostrar</h1>';
    } else {
        foreach($array as $item) {
            insertCard($item['title']);
        }
    }
}
?>