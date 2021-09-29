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
            'label' => 'LLL:EXT:solr_enhancement/Resources/Private/Language/locallang.xlf:contextmenu.remove', // you can use "LLL:" syntax here
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
        return [
            // BEWARE!!! RequireJS MODULES MUST ALWAYS START WITH "TYPO3/CMS/" (and no "Vendor" segment here)
            'data-callback-module' => 'TYPO3/CMS/SolrEnhancement/ContextMenuActions',
            // Here you can also add any other useful "data-" attribute you'd like to use in your JavaScript (e.g. localized messages)
        ];
    }
}
