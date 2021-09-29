<?php
/**
 * Definitions of routes
 */
return [
    'web_list_solrrecordclear' => [
        'path' => '/web/list/solrrecordclear',
        'target' => \StudioMitte\SolrEnhancement\Controller\SolrRemoveRecordController::class . '::mainAction'
    ],
];
