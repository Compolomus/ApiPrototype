<?php

require 'header.php';

use Compolomus\Prototype\Utils\Template;
use Compolomus\Prototype\Utils\Config;

if (!file_exists(CONFIG_DIR . 'settings.php')) {
    @mkdir(CONFIG_DIR, '777', true);

    if ($_POST['submit']) {

        $prefix = $_POST['prefix'] ?? 'prefix';
        $db_driver = $_POST['db_driver'] ?? 'db_driver';
        $response = $_POST['response'] ?? 'array';
        $data = ['comments', 'like', 'attach', 'tag'];
        $result = [];

        foreach ($_POST as $key => $field) {
            $result[$key] = ('on' === $field);
        }

        unset($result['submit']);
        $result['prefix'] = $prefix;
        $result['response'] = $response;
        $result['db_driver'] = $db_driver;

        (new Config($result))->save(CONFIG_DIR . 'settings');

        echo '<h2>Конфиг сохранен</h2>';
    } else {
        $config = (new config(include '../src/.config/config.dist'))->getConfig();

        $tpl = new Template('tpl', 'tpl');

        echo $tpl->render('configurator', ['config' => $config]);
    }
} else {
    echo '<h2>Для продолжения нужно удалить файл настроек</h2>';
}

require 'footer.php';
