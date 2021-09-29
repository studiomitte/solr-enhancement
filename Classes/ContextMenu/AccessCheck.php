<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\ContextMenu;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AccessCheck
{
    protected ExtensionConfiguration $extensionConfiguration;

    public function __construct(ExtensionConfiguration $extensionConfiguration = null)
    {
        $this->extensionConfiguration = $extensionConfiguration ?: GeneralUtility::makeInstance(ExtensionConfiguration::class);
    }

    public function tableIsValid(string $tableName): bool
    {
        $config = $this->extensionConfiguration->get('solr_enhancement');
        $tables = GeneralUtility::trimExplode(',', $config['tables'] ?? '', true);
        return in_array($tableName, $tables, true);
    }
}
