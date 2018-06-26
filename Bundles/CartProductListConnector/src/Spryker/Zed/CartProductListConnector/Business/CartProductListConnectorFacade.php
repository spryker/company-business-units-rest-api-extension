<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CartProductListConnector\Business;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\CartProductListConnector\Business\CartProductListConnectorBusinessFactory getFactory()
 */
class CartProductListConnectorFacade extends AbstractFacade implements CartProductListConnectorFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function filterRestrictedItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()
            ->createRestrictedItemsFilter()
            ->filterRestrictedItems($quoteTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function validateItemAddProductListRestrictions(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        return $this->getFactory()
            ->createProductListRestrictionValidator()
            ->validateItemAddition($cartChangeTransfer);
    }
}
