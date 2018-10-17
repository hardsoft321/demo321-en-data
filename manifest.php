<?php
$manifest = array(
    'name' => 'demo321-en-data',
    'acceptable_sugar_versions' => array(),
    'acceptable_sugar_flavors' => array('CE'),
    'author' => 'hardsoft321',
    'description' => 'Demo data for https://demo.lab321.ru/en/suitecrm/',
    'is_uninstallable' => true,
    'published_date' => '2018-11-16',
    'type' => 'module',
    'dependencies' => array(
        array(
            'id_name' => 'dbgit',
            'version' => '1'
        ),
    ),
    'version' => '1.0.0',
);
$installdefs = array(
    'id' => 'demo321-en-data',
    'copy' => array(
        array(
            'from' => '<basepath>/source/copy',
            'to' => '.'
        ),
    ),
);
