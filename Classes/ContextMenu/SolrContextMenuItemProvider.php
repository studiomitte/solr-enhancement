<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\ContextMenu;

use TYPO3\CMS\Backend\ContextMenu\ItemProviders\AbstractProvider;

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

        //passes array of items to the next item provider
        $items = $items + $this->prepareItems($this->itemsConfiguration);
        return $items;
    }

    public function getPriority(): int
    {
        return 19;
    }

    public function canHandle(): bool
    {
        return AccessCheck::tableIsValid($this->table);
    }

    protected function getAdditionalAttributes(string $itemName): array
    {
        $module = version_compare(TYPO3_version, '10.0.0', '>=') ? 'TYPO3/CMS/SolrEnhancement/ContextMenuActions' : 'TYPO3/CMS/SolrEnhancement/ContextMenuActions9';
        return [
            'data-callback-module' => $module,
        ];
    }
}
