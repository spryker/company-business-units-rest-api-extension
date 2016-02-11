<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\ProductSearch\Persistence;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributesOperationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\ProductSearch\ProductSearchDependencyProvider;

/**
 * @method \Spryker\Zed\ProductSearch\Persistence\ProductSearchQueryContainer getQueryContainer()
 * @method \Spryker\Zed\ProductSearch\ProductSearchConfig getConfig()
 */
class ProductSearchPersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \Spryker\Zed\ProductSearch\Persistence\ProductSearchQueryExpanderInterface
     */
    public function createProductSearchQueryExpander()
    {
        return new ProductSearchQueryExpander(
            $this->getProductQueryContainer()
        );
    }

    /**
     * @return \Spryker\Zed\Product\Persistence\ProductQueryContainerInterface
     */
    protected function getProductQueryContainer()
    {
        return $this->getProvidedDependency(ProductSearchDependencyProvider::QUERY_CONTAINER_PRODUCT);
    }

    /**
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributesOperationQuery
     */
    public function createProductSearchAttributesOperationQuery()
    {
        return SpyProductSearchAttributesOperationQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function createProductQuery()
    {
        return SpyProductQuery::create();
    }

}