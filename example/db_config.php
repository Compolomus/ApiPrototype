<?php

require 'header.php';

use Compolomus\Prototype\Utils\Template;
use Compolomus\Prototype\Utils\Config;

$config = (new config(include CONFIG_DIR . 'settings.php'))->getConfig();
$driver = $config['db_driver'];
$prefix = $config['prefix'];

$db_config = (new config(include '../src/.config/db_config.dist'))->getConfig();

if (!file_exists(CONFIG_DIR . 'db_settings.php')) {
    if ($_POST['submit']) {

        unset($_POST['submit']);

        $db_config[$driver] = $_POST;

        #echo '<pre>' . print_r($_POST, true) . '</pre>'; die;

        (new Config($db_config))->save(CONFIG_DIR . 'db_settings');

        echo '<h2>Конфиг сохранен</h2>';
    } else {
        $tpl = new Template('tpl', 'tpl');

        echo $tpl->render('db_configurator', ['db_config' => $db_config[$driver], 'prefix' => $prefix]);
    }
} else {
    echo '<h2>Для продолжения нужно удалить файл настроек</h2>';
}

require 'footer.php';
