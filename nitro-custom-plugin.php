<?php
/**
 * NitroCustomPlugin
 *
 * Plugin Name: پلاگین اختصاصی نیتروپراپ
 * Description: این افزونه برای سایت نیتروپراپ طراحی شده و تمامی کدهای بخش های مختلف سایت در این پلاگین گنجانده شده

 * Version:     8.3.3
 * Author:      Hamed Safari & AliDlt
 */

defined('ABSPATH') or die('Access Denied!');

const NCP_VER = '8.3.3';

define('NCP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NCP_PLUGIN_URL', plugin_dir_url(__FILE__));
const NCP_PLUGIN_INCLUDES = NCP_PLUGIN_DIR . 'includes/';
const NCP_PLUGIN_INCLUDES_URL = NCP_PLUGIN_URL . 'includes/';
const NCP_PLUGIN_TEMPLATES = NCP_PLUGIN_DIR . 'templates/';
const NCP_PLUGIN_TEMPLATES_URL = NCP_PLUGIN_URL . 'templates/';
const NCP_PLUGIN_RULES = NCP_PLUGIN_TEMPLATES . 'rules/';
const NCP_PLUGIN_RULES_URL = NCP_PLUGIN_TEMPLATES_URL . 'rules/';



include_once NCP_PLUGIN_INCLUDES . 'setup-plugin.php';
include_once NCP_PLUGIN_INCLUDES . 'hooks.php';
include_once NCP_PLUGIN_INCLUDES . 'functions.php';


register_activation_hook(__FILE__, 'create_nitro_table');


