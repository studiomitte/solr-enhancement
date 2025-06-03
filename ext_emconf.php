<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Solr Enhancements',
    'description' => 'Small enhancements for solr extension',
    'category' => 'be',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'author_company' => 'StudioMitte',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '13.4.13-13.4.99',
                    'solr' => '13.0.2-13.99.99'
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
