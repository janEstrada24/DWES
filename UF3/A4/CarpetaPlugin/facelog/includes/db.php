<?php
// TODO: Cal implementar tota la funcionalitat

function connexio() {
    try {
      global $wpdb;     
      $mydb = new wpdb('wordpress', 'wordpress', 'wordpress', 'localhost');
      return $mydb;
    } catch (Exception $e) {
      return false;
    }
}

function createTableLogs() {
    global $wpdb;     

    if (!$wpdb) {
        return false;
    } else {
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS wp_logs_facelog (
            id int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_log varchar(100),
            image_log varchar(250),
            date_log Date
            ) $charset_collate;";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        update_option( 'myplugin_version', '0.1' );
        
        $query = $wpdb->get_row($sql);

        foreach($files as $fila)
        {
          $idPost = $query->ID;
        }

        var_dump($query);
        return $query;
    }
}

function deleteTableLogs() {
  global $wpdb;     

  if (!$wpdb) {
      return false;
  } else {
      $charset_collate = $wpdb->get_charset_collate();
      
      $sql = "DROP TABLE IF EXISTS wp_logs_facelog;";
      
      $wpdb->query( $sql );

      delete_option( 'myplugin_version' );
  }
}

function facelog_dbget($user)
{
    global $wpdb;     

    if (!$wpdb) {
        return false;
    } else {
        $sql = $wpdb->prepare("SELECT * FROM wp_users WHERE user_login = %s", $user);
                
        $files = $wpdb->get_results($sql);

        foreach($files as $fila)
        {
          $idPost = $fila->ID;
        }

        return $fila;
    }
}