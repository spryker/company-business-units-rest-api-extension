<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductRelation\Dependency\Facade;

interface ProductRelationToPriceProductFacadeInterface
{
    /**
     * @param string $sku
     *
     * @return int|null
     */
    public function findPriceBySku($sku);
}
