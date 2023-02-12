<?php
  require_once "includes/db.php";
  require_once "includes/custom-pages.php";

  /**
   * Plugin Name: FaceLog Plugin
   * Plugin URI: http://boscdelacoma.cat
   * Description: Pràctica MP07.
   * Version: 0.1
   * Author: Jan Estrada
   * Author URI:  http://boscdelacoma.cat
   **/

  const FACELOG_DB_VERSION = '1.0';
  const FACELOG_VERSION= '1.0';
  
  // Allow subscribers to see Private posts and pages
  $subRole = get_role( 'subscriber' );
  $subRole->add_cap( 'read_private_posts' );
  $subRole->add_cap( 'read_private_pages' );
  
  // Afegim els shortcodes de la pagina publica i la privada
  add_shortcode('facelogPublic', 'facelog_gallery');
  add_shortcode('facelogPrivate', 'facelog_addlog');

  function createPublicPage() {

    // Crear la pagina publica afegint el shortcode
    $paginaPublica = array(
      'post_title'    => "log",
      'post_content'  => "[facelogPublic]",
      'post_status'   => 'publish',
      'post_type'   => "page",
      'post_author'   => "admin",
    );

    // Inserir la pagina a la base de dades
    wp_insert_post( $paginaPublica );

  }

  function createPrivatePage() {

    // Crear la pagina privada afegint el shortcode
    $paginaPrivada = array(
      'post_title'    => "add-log",
      'post_content'  => "[facelogPrivate]",
      'post_status'   => 'private',
      'post_type'   => "page",
      'post_author'   => "admin",
    );

    wp_insert_post( $paginaPrivada );

  }
  
  function deletePublicPage() {

    $wpdb = connexio();

    if (!$wpdb) {
      return false;
    } else {
        $files = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_title = 'log'"); 

        foreach($files as $fila)
        {
          $idPost = $fila->ID;
          wp_delete_post($idPost, false);
        }
    }
  }

  function deletePrivatePage() {

    $wpdb = connexio();

    if (!$wpdb) {
      return false;
    } else {
        $files = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_title = 'add-log'"); 

        foreach($files as $fila)
        {
          $idPost = $fila->ID;
          wp_delete_post($idPost, false);
        }
        
    }
  }

  // Eliminar el contingut del directori on guardem les imatges
  function deleteDirContent() {
    $dirPath = "uploads/tmp/";

    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    var_dump($files);
    foreach ($files as $file) {
        // Ens assegurem de no eliminar el fitxer index.php i eliminar nomes les imatges
        if ($file["name"] != "index.php") {
          unlink($file);
        } else {
        }
    }
  }

  // Carreguem la fulla d estils del plugin a Wordpress
  function carregarEstilsPlugin() {
    $plugin_url = plugin_dir_url(__FILE__);
    wp_enqueue_style( 'style', $plugin_url . 'assets/css/style.css' );
  }

  add_action( 'wp_enqueue_scripts', 'carregarEstilsPlugin' );

  register_activation_hook(__FILE__, 'createPrivatePage');
  register_activation_hook(__FILE__, 'createPublicPage');
  register_activation_hook(__FILE__, 'createTableLogs');

  register_deactivation_hook(__FILE__, 'deletePrivatePage');
  register_deactivation_hook(__FILE__, 'deletePublicPage');
  register_deactivation_hook(__FILE__, 'deleteTableLogs');
  register_deactivation_hook(__FILE__, 'deleteDirContent');