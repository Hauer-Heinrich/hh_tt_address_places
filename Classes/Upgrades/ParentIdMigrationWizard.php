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
use \TYPO3\CMS\Core\Database\Connection;
use \TYPO3\CMS\Core\Database\ConnectionPool;

#[UpgradeWizard('hhttaddressplaces_parentIdMigrationWizard')]
final class ParentIdMigrationWizard implements UpgradeWizardInterface, ChattyInterface {

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
        return 'hhttaddressplaces_parentIdMigrationWizard';
    }

    /**
     * Return the speaking name of this wizard
     */
    public function getTitle(): string {
        return 'EXT:hh_tt_address_places - Migration of field "place"';
    }

    /**
     * Return the description for this wizard
     */
    public function getDescription(): string {
        return 'Migration of field "place" to "parentid" and "parenttable", set default "parenttable" to "tt_address"!!!';
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

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_hhttaddressplaces_domain_model_periodoftime');
        $queryBuilder->getRestrictions()->removeAll();

        foreach ($affectedRows as $row) {
            $queryBuilder->update('tx_hhttaddressplaces_domain_model_periodoftime');
            $queryBuilder->where(
                $queryBuilder->expr()->eq('uid', $row['uid'])
            );
            $queryBuilder->set('parentid', $row['place']);
            $queryBuilder->set('parenttable', 'tt_address');
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_hhttaddressplaces_domain_model_periodoftime');
        $queryBuilder->getRestrictions()->removeAll();
        $whereExpressions = [];

        $whereExpressions[] = $queryBuilder->expr()->gt('place', 0);
        $whereExpressions[] = $queryBuilder->expr()->eq('parentid', 0);
        $whereExpressions[] = $queryBuilder->expr()->eq('parenttable', $queryBuilder->createNamedParameter('', Connection::PARAM_STR));

        $queryBuilder
            ->select('uid', 'place')
            ->from('tx_hhttaddressplaces_domain_model_periodoftime');
        $queryBuilder->where(...$whereExpressions);
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_hhttaddressplaces_domain_model_periodoftime');
        $queryBuilder->getRestrictions()->removeAll();
        $whereExpressions = [];

        $whereExpressions[] = $queryBuilder->expr()->gt('place', 0);
        $whereExpressions[] = $queryBuilder->expr()->eq('parentid', 0);
        $whereExpressions[] = $queryBuilder->expr()->eq('parenttable', $queryBuilder->createNamedParameter('', Connection::PARAM_STR));

        $queryBuilder
            ->select('uid', 'place')
            ->from('tx_hhttaddressplaces_domain_model_periodoftime');
        $queryBuilder->where(...$whereExpressions);
        $results = $queryBuilder->executeQuery()->fetchAllAssociative();

        if(!empty($results) && \is_array($results)) {
            return $results;
        }

        return [];
    }
}
