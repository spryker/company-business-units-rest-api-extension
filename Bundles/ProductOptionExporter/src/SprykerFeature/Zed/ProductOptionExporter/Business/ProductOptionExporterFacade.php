<?php


namespace SprykerFeature\Zed\ProductOptionExporter\Business;

use SprykerEngine\Zed\Kernel\Business\AbstractFacade;

/**
 * @method ProductOptionExporterDependencyContainer getDependencyContainer()
 *
 * (c) Spryker Systems GmbH copyright protected
 */
class ProductOptionExporterFacade extends AbstractFacade
{
    /**
     * @param array $resultSet
     * @param array $processedResultSet
     *
     * @return array
     */
    public function processDataForExport(array &$resultSet, array $processedResultSet)
    {
        return $this->getDependencyContainer()->getProcessorModel()->processDataForExport($resultSet, $processedResultSet);
    }
}
