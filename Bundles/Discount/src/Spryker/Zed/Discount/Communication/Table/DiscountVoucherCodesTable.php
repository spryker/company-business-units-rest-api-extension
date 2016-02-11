<?php

namespace Spryker\Zed\Discount\Communication\Table;

use Generated\Shared\Transfer\DataTablesTransfer;
use Spryker\Zed\Discount\Persistence\DiscountQueryContainer;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountVoucherTableMap;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class DiscountVoucherCodesTable extends AbstractTable
{

    /**
     * @var \Orm\Zed\Discount\Persistence\SpyDiscountQuery
     */
    protected $discountQueryContainer;

    /**
     * @var \Generated\Shared\Transfer\DataTablesTransfer
     */
    protected $dataTablesTransfer;

    /**
     * @var int
     */
    protected $idPool;

    /**
     * @var int
     */
    protected $batchValue;

    /**
     * @param \Spryker\Zed\Discount\Persistence\DiscountQueryContainer $discountQueryContainer
     * @param int $idPool
     * @param int $batchValue
     */
    public function __construct(DataTablesTransfer $dataTablesTransfer, DiscountQueryContainer $discountQueryContainer, $idPool, $batchValue = null)
    {
        $this->dataTablesTransfer = $dataTablesTransfer;
        $this->discountQueryContainer = $discountQueryContainer;
        $this->idPool = $idPool;
        $this->batchValue = $batchValue;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setUrl('table/?id-pool=' . $this->idPool . '&batch=' . $this->batchValue);
        $this->tableClass = 'table-data-codes';

        $config->setHeader([
            SpyDiscountVoucherTableMap::COL_CODE => 'Voucher Code',
            SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES => 'Used',
            SpyDiscountVoucherTableMap::COL_CREATED_AT => 'Created At',
            SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH => 'Batch Value',
        ]);

        $config->setSortable([
            SpyDiscountVoucherTableMap::COL_CODE,
            SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES,
            SpyDiscountVoucherTableMap::COL_CREATED_AT,
            SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH,
        ]);

        $config->setFooterFromHeader();

        $config->setSearchable(
            array_keys($config->getHeader())
        );

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $generatedVoucherCodesQuery = $this->discountQueryContainer
            ->queryDiscountVoucher()
            ->filterByFkDiscountVoucherPool($this->idPool);

        if ($this->batchValue !== '') {
            $generatedVoucherCodesQuery->filterByVoucherBatch($this->batchValue);
        }

        $collectionObject = $this->runQuery($generatedVoucherCodesQuery, $config, true);

        $result = [];

        /** @var \Orm\Zed\Discount\Persistence\SpyDiscountVoucher $code */
        foreach ($collectionObject as $code) {
            $result[] = [
                SpyDiscountVoucherTableMap::COL_CODE => $code->getCode(),
                SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES => (int) $code->getNumberOfUses(),
                SpyDiscountVoucherTableMap::COL_CREATED_AT => $code->getCreatedAt('Y-m-d'),
                SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH => $code->getVoucherBatch(),
            ];
        }

        return $result;
    }

}