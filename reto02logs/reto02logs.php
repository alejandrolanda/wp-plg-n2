<?php
/**
* Plugin Name: Reto 02: Plugin para ver logs internos del server
* Plugin URI: #
* Description: Se solicita crear un plugin wordpress que al instalarse, habilite un opcion en el administrador para poder ver los logs
clasicos de wordpress
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 7.2, 7.3
* Author: Jesús Landa
* Author URI: #
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: reto02logs
* Domain Path: /languages
*/
if( !function_exists( 'res_options_page_logs' ) ){
  function res_options_page_logs(){
    add_menu_page(
    'Reto 02 - Logs WPs',
    'Reto 02 - Logs WPs',
    'manage_options',
    'res_options_page_logs',
    'res_options_page_logs_display',
    'dashicons-sos',
    '16'
    );
  }
  add_action( 'admin_menu', 'res_options_page_logs' );
}

if( !function_exists( 'res_options_page_logs_display')){
  function res_options_page_logs_display(){
    ?>
    <div class="wrap">
      <h1>Show Logs Server</h1>
      <hr>
    <?php
      /*
      Nota 1: 
      - Modificar: wp-config.php los valores 
          define('WP_DEBUG', true);
          define('WP_DEBUG_LOG', true);
        Se activará: debug.log
        "/htdocs/wp-content/debug.log"
      */
      $wRutaNameFile = ini_get('error_log'); 
      if ( WP_DEBUG_LOG AND file_exists($wRutaNameFile)) {
        echo '<h2>DEBUG de Wordpress: </h2>';
        $wNameFile="debug.log";
        $wFileLogErrRoot=WP_CONTENT_DIR.'/'.$wNameFile;
        echo "<p><b>Archivo:</b> " . $wFileLogErrRoot. "</p>";
        $archivo=fopen($wFileLogErrRoot,"r");
        echo '<table class="widefat importers striped">';
        echo "<tbody>";
        while ($line = fgets($archivo)) {
          echo "<tr>"; 
            echo "<td>";
              echo($line)."";
            echo "</td>";
          echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
        fclose($archivo);
        echo '<br/>';
      }
      /*
      Nota 2: {OBS}
      - Para acceder a los archivos logs del SERVIDOR
          access.log, error.log , install.log
        Por ejemplo para una version de Windows con Xampp
        la ruta seria:
          c:\xampp\apache\logs
        Para variantes de linux: las posibilidades serian
          /var/log/httpd/error_log
          /var/log/apache2/error.log
          /usr/local/apache/logs/error_log
          /usr/local/apache/logs/error_log
          /var/log/httpd/access_log
          /var/log/httpd-error.log
          /var/log/apache
          /var/log/apache2
      */
        echo '<h2 class="wp-heading-inline">SERVER:: error.log </h2>';
        $wFileLogErrRoot="/xampp/apache/logs/error.log";
        echo "Archivo: " . $wFileLogErrRoot; echo "<br>"; echo "<hr>";
        if (file_exists($wFileLogErrRoot)) {
          $archivo=fopen($wFileLogErrRoot,"r");
          echo '<table class="widefat importers striped">';
          while ($line = fgets($archivo)) {
            echo "<tr>"; 
              echo "<td>";
                echo($line)."";
              echo "</td>";
            echo "</tr>";
          }
          echo '</tbody>';
          echo '</table>';
          fclose($archivo);
        }
?>
      <p>...</p>
      <p>..</p>
      <p>.</p>
    </div>
    <?php
  }
}
