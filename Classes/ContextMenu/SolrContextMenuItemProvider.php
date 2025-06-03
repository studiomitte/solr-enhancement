<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\ContextMenu;

use TYPO3\CMS\Backend\ContextMenu\ItemProviders\AbstractProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SolrContextMenuItemProvider extends AbstractProvider
{

    /**
     * This array contains configuration for items you want to add
     * @var array
     */
    protected $itemsConfiguration = [
        'hello' => [
            'type' => 'item',
            'label' => 'LLL:EXT:solr_enhancement/Resources/Private/Language/locallang.xlf:contextmenu.remove',
            'iconIdentifier' => 'actions-edit-delete',
            'callbackAction' => 'removeFromSolr'
        ]
    ];

    public function addItems(array $items): array
    {
        $this->initDisabledItems();

        return $items + $this->prepareItems($this->itemsConfiguration);
    }

    public function getPriority(): int
    {
        return 19;
    }

    public function canHandle(): bool
    {
        $accessCheck = GeneralUtility::makeInstance(AccessCheck::class);
        return $accessCheck->tableIsValid($this->table);
    }

    protected function getAdditionalAttributes(string $itemName): array
    {
        return [
            'data-callback-module' => '@studiomitte/solrenhancement/context-menu-actions',
        ];
    }
}
