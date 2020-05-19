<?php
/*
Plugin Name: alex-plugin
Plugin URI: https://www.alexmedina.net
Description: Plugin de ejemplo del post de como crear un plugin en WordPress
Version: 1.0
Author: Alex Medina
Author URI: https://www.alexmedina.net
License: GPL2
*/

function shortcode_test($atts = [], $content = null, $tag = ''){

    // --- ATRIBUTOS
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    // override default attributes with user attributes
    $escape_atts = shortcode_atts([
                                     'title' => 'AlexMedina.net',
                                     'id' => 'NULL'
                                 ], $atts, $tag);


    // --- ACCESO BASE DE DATOS
    global $wpdb;
    $mitabla = $wpdb->base_prefix."prueba";         

    //si no pasamos variables no hay que usar prepare
    $results = $wpdb->get_results($wpdb->prepare("select * from $mitabla WHERE id=%d",$escape_atts["id"]));

    $tabla_resultados = "<br>";
    foreach ($results as $valor){
        $tabla_resultados =  $tabla_resultados . $valor->id  ." -> ".$valor->nombre."<br>";
    }

    // --- RESULTADO
    $res .= 'PARAMETROS => title:'.$escape_atts["title"].' | id:'.$escape_atts["id"].' <br>';
    $res .= 'RESULTADO SQL => '.$tabla_resultados.'<br>';

    return $res;
}
add_shortcode('test', 'shortcode_test');



// CREATE TABLE `c8GYXyE0_prueba` (
//     `id` int(11) NOT NULL,
//     `nombre` text NOT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
//   INSERT INTO `c8GYXyE0_prueba` (`id`, `nombre`) VALUES
//   (1, 'perro'),
//   (2, 'gato');
  
  
//   ALTER TABLE `c8GYXyE0_prueba`
//     ADD PRIMARY KEY (`id`);
  
  
//   ALTER TABLE `c8GYXyE0_prueba`
//     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
//   COMMIT;

?>