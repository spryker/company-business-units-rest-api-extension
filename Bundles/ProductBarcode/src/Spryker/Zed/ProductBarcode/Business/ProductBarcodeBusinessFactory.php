<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductBarcode\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductBarcode\Business\ProductBarcodeGenerator\ProductBarcodeGenerator;
use Spryker\Zed\ProductBarcode\ProductBarcodeDependencyProvider;

class ProductBarcodeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\ProductBarcode\Business\ProductBarcodeGenerator\ProductBarcodeGeneratorInterface
     */
    public function createProductBarcodeGenerator(): ProductBarcodeGenerator
    {
        return new ProductBarcodeGenerator();
    }

    /**
     * @return mixed
     */
    public function getBarcodeGeneratorService()
    {
        return $this->getProvidedDependency(ProductBarcodeDependencyProvider::BARCODE_GENERATOR_SERVICE);
    }
}
