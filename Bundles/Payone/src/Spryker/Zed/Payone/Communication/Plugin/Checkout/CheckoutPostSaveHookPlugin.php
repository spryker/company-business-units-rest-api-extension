<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payone\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPostSaveHookInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\Payone\Communication\PayoneCommunicationFactory getFactory()
 * @method \Spryker\Zed\Payone\Business\PayoneFacade getFacade()
 */
class CheckoutPostSaveHookPlugin extends AbstractPlugin implements CheckoutPostSaveHookInterface
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     *
     * @return void
     */
    public function executeHook(OrderTransfer $orderTransfer, CheckoutResponseTransfer $checkoutResponse)
    {
        $this->getFacade()->postSaveHook($orderTransfer, $checkoutResponse);
    }

}