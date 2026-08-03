<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Upgrades;

use \Symfony\Component\Console\Output\OutputInterface;
// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Install\Attribute\UpgradeWizard;
use \TYPO3\CMS\Install\Updates\UpgradeWizardInterface;
use \TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use \TYPO3\CMS\Install\Updates\ChattyInterface;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

#[UpgradeWizard('hhttaddressplaces_updateTxExtbaseTypeMigrationWizard')]
final class UpdateTxExtbaseTypeMigrationWizard implements UpgradeWizardInterface, ChattyInterface {

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Setter injection for output into upgrade wizards
     */
    public function setOutput(OutputInterface $output): void {
        $this->output = $output;
    }

    /**
     * Return the identifier for this wizard
     * This should be the same string as used in the ext_localconf class registration
     *
     * @return string
     */
    public function getIdentifier(): string {
        return 'hhttaddressplaces_updateTxExtbaseTypeMigrationWizard';
    }

    /**
     * Return the speaking name of this wizard
     */
    public function getTitle(): string {
        return 'EXT:hh_tt_address_places - Default value of field "tx_extbase_type"';
    }

    /**
     * Return the description for this wizard
     */
    public function getDescription(): string {
        return 'Default value of field "tx_extbase_type" set to "default" of table tt_address!';
    }

    /**
     * Execute the update
     *
     * Called when a wizard reports that an update is necessary
     */
    public function executeUpdate(): bool {
        $affectedRows = $this->getAffectedRows();

        if(empty($affectedRows)) {
            return true;
        }

        $this->output->writeln('Performing ' . count($affectedRows) . ' database operations.');

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_address');
        $queryBuilder->getRestrictions()->removeAll();

        foreach ($affectedRows as $row) {
            $queryBuilder->update('tt_address');
            $queryBuilder
                ->where(
                    $queryBuilder->expr()->eq('uid', $row['uid']),
                    $queryBuilder->expr()->or(
                        $queryBuilder->expr()->eq('tx_extbase_type', 'ttAddress_default'),
                        $queryBuilder->expr()->eq('tx_extbase_type', 'ttaddress_default'),
                        $queryBuilder->expr()->eq('tx_extbase_type', '')
                    )
                )
                ->set('tx_extbase_type', 'default');
            $queryBuilder->executeStatement();
        }

        return true;
    }

    /**
     * Is an update necessary?
     *
     * Is used to determine whether a wizard needs to be run.
     * Check if data for migration exists.
     *
     * @return bool Whether an update is required (TRUE) or not (FALSE)
     */
    public function updateNecessary(): bool {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_address');
        $queryBuilder->getRestrictions()->removeAll();

        // check if the field "tx_extbase_type" exists
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_address');
        $schemaManager = $connection->createSchemaManager();
        $columns = $schemaManager->listTableColumns('tt_address');
        if (!isset($columns['tx_extbase_type'])) {
            return false;
        }

        $queryBuilder
            ->select('uid', 'tx_extbase_type')
            ->from('tt_address');
        $queryBuilder->where(
            $queryBuilder->expr()->or(
                $queryBuilder->expr()->eq('tx_extbase_type', 'ttAddress_default'),
                $queryBuilder->expr()->eq('tx_extbase_type', 'ttaddress_default'),
                $queryBuilder->expr()->eq('tx_extbase_type', '')
            )
        );
        $results = $queryBuilder->executeQuery()->fetchAllAssociative();

        if(!empty($results)) {
            return true;
        }

        return false;
    }

    /**
     * Returns an array of class names of prerequisite classes
     *
     * This way a wizard can define dependencies like "database up-to-date" or
     * "reference index updated"
     *
     * @return string[]
     */
    public function getPrerequisites(): array {
        // Add your logic here
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getAffectedRows(): array {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_address');
        $queryBuilder->getRestrictions()->removeAll();

        // check if the field "tx_extbase_type" exists
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_address');
        $schemaManager = $connection->createSchemaManager();
        $columns = $schemaManager->listTableColumns('tt_address');
        if (!isset($columns['tx_extbase_type'])) {
            return [];
        }

        $queryBuilder
            ->select('uid', 'place')
            ->from('tt_address');
        $queryBuilder->where(
            $queryBuilder->expr()->or(
                $queryBuilder->expr()->eq('tx_extbase_type', 'ttAddress_default'),
                $queryBuilder->expr()->eq('tx_extbase_type', 'ttaddress_default'),
                $queryBuilder->expr()->eq('tx_extbase_type', '')
            )
        );
        $results = $queryBuilder->executeQuery()->fetchAllAssociative();

        if(!empty($results) && \is_array($results)) {
            return $results;
        }

        return [];
    }
}
