<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Solr Enhancements',
    'description' => 'Small enhancements for solr extension',
    'category' => 'be',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'author_company' => 'StudioMitte',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '0.1.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '9.5.0-10.4.99',
                    'solr' => '10.0.0-11.99.99'
                ],
        ],
    'autoload' =>
        [
            'psr-4' =>
                [
                    'StudioMitte\\Enhancement\\' => 'Classes',
                ],
        ]
];
