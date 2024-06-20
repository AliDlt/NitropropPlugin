<?php
defined('ABSPATH') or die('Access Denied!');

function create_nitro_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        account_id mediumint(9) NOT NULL,
        full_name varchar(255) NOT NULL,
        birth_date varchar(255) NOT NULL,
        code_melli varchar(10) NOT NULL,
        cart_melli_url varchar(255) NOT NULL,
        selfie_url varchar(255) NOT NULL,
        auth_status mediumint(9) NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}