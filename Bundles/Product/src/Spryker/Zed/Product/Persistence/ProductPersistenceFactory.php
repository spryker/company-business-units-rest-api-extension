<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Product\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAttributesMetadataQuery;
use Orm\Zed\Product\Persistence\SpyProductAttributeTypeQuery;
use Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\Product\ProductConfig getConfig()
 * @method \Spryker\Zed\Product\Persistence\ProductQueryContainer getQueryContainer()
 */
class ProductPersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function createProductQuery()
    {
        return SpyProductQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery
     */
    public function createProductLocalizedAttributesQuery()
    {
        return SpyProductLocalizedAttributesQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery
     */
    public function createProductAbstractLocalizedAttributesQuery()
    {
        return SpyProductAbstractLocalizedAttributesQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAttributeTypeQuery
     */
    public function createProductAttributeTypeQuery()
    {
        return SpyProductAttributeTypeQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAttributesMetadataQuery
     */
    public function createProductAttributesMetadataQuery()
    {
        return SpyProductAttributesMetadataQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function createProductAbstractQuery()
    {
        return SpyProductAbstractQuery::create();
    }

    /**
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function createTaxSetQuery()
    {
        return SpyTaxSetQuery::create();
    }

}