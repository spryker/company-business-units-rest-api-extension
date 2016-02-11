<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Checkout\Business\Workflow;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutRequestTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Checkout\Business\Workflow\CheckoutWorkflow;
use Unit\Spryker\Zed\Checkout\Business\Fixture\MockOrderHydrator;
use Unit\Spryker\Zed\Checkout\Business\Fixture\MockOrderSaver;
use Unit\Spryker\Zed\Checkout\Business\Fixture\MockPostHook;
use Unit\Spryker\Zed\Checkout\Business\Fixture\ResponseManipulatorPreCondition;

/**
 * @group Spryker
 * @group Zed
 * @group Checkout
 * @group CheckoutWorkflowTest
 */
class CheckoutWorkflowTest extends Test
{

    /**
     * @return void
     */
    public function testWorkflowCallsAllPreConditions()
    {
        $mock1 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutPreConditionInterface');
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutPreConditionInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutRequest = new CheckoutRequestTransfer();
        $checkoutResponse = new CheckoutResponseTransfer();

        $mock1->expects($this->once())->method('checkCondition')->with(
            $this->equalTo($checkoutRequest),
            $this->equalTo($checkoutResponse)
        );

        $mock2->expects($this->once())->method('checkCondition')->with(
            $this->equalTo($checkoutRequest),
            $this->equalTo($checkoutResponse)
        );

        $checkoutWorkflow = new CheckoutWorkflow([$mock1, $mock2], [], [], [], [], $omsMock);

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testWorkflowCallsAllHydrators()
    {
        $mock1 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutOrderHydrationInterface');
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutOrderHydrationInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $order = new OrderTransfer();
        $checkoutRequest = new CheckoutRequestTransfer();

        $mock1->expects($this->once())->method('hydrateOrder')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutRequest)
        );

        $mock2->expects($this->once())->method('hydrateOrder')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutRequest)
        );

        $checkoutWorkflow = new CheckoutWorkflow([], [], [$mock1, $mock2], [], [], $omsMock);

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testWorkflowCallsAllOrderSavers()
    {
        $mock1 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutSaveOrderInterface');
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutSaveOrderInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $order = new OrderTransfer();
        $checkoutRequest = new CheckoutRequestTransfer();
        $checkoutResponse = new CheckoutResponseTransfer();

        $mock1->expects($this->once())->method('saveOrder')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutResponse)
        );

        $mock2->expects($this->once())->method('saveOrder')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutResponse)
        );

        $checkoutWorkflow = new CheckoutWorkflow([], [], [], [$mock1, $mock2], [], $omsMock);

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testWorkflowCallsAllPostHooks()
    {
        $mock1 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutPostSaveHookInterface');
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutPostSaveHookInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $order = new OrderTransfer();
        $checkoutRequest = new CheckoutRequestTransfer();
        $checkoutResponse = new CheckoutResponseTransfer();

        $mock1->expects($this->once())->method('executeHook')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutResponse)
        );

        $mock2->expects($this->once())->method('executeHook')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutResponse)
        );

        $checkoutWorkflow = new CheckoutWorkflow([], [], [], [], [$mock1, $mock2], $omsMock);

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testWorkflowPassesResponseOn()
    {
        $checkoutResponse = new CheckoutResponseTransfer();
        $checkoutResponse
            ->setIsExternalRedirect(true)
            ->setRedirectUrl('anUrl');

        $mock1 = new ResponseManipulatorPreCondition($checkoutResponse);
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutSaveOrderInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutRequest = new CheckoutRequestTransfer();
        $order = new OrderTransfer();

        $checkoutWorkflow = new CheckoutWorkflow([$mock1], [], [], [$mock2], [], $omsMock);

        $mock2->expects($this->once())->method('saveOrder')->with(
            $this->equalTo($order),
            $this->equalTo($checkoutResponse)
        );

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testHydratorIsNotCalledIfErrorInPreCondition()
    {
        $checkoutResponse = new CheckoutResponseTransfer();
        $error = new CheckoutErrorTransfer();

        $checkoutResponse
            ->addError($error)
            ->setIsSuccess(false);

        $mock1 = new ResponseManipulatorPreCondition($checkoutResponse);
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutSaveOrderInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutWorkflow = new CheckoutWorkflow([$mock1], [], [], [$mock2], [], $omsMock);
        $checkoutRequest = new CheckoutRequestTransfer();

        $mock2->expects($this->never())->method('saveOrder');

        $result = $checkoutWorkflow->requestCheckout($checkoutRequest);
        $this->assertEquals($checkoutResponse, $result);
    }

    /**
     * @return void
     */
    public function testWorkflowPassesHydratedOrderOnToSave()
    {
        /** @var \Generated\Shared\Transfer\OrderTransfer $orderTransfer */
        $orderTransfer = new OrderTransfer();

        $orderTransfer
            ->setProcess('a process')
            ->setIdSalesOrder(10);

        $mock1 = new MockOrderHydrator($orderTransfer);
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutSaveOrderInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutWorkflow = new CheckoutWorkflow([], [], [$mock1], [$mock2], [], $omsMock);
        $checkoutRequest = new CheckoutRequestTransfer();

        $mock2->expects($this->once())->method('saveOrder')->with(
            $this->equalTo($orderTransfer),
            $this->anything()
        );

        $checkoutWorkflow->requestCheckout($checkoutRequest);
    }

    /**
     * @return void
     */
    public function testPosthookNotCalledAndResponseReturnedOnSaveError()
    {
        $checkoutResponse = new CheckoutResponseTransfer();
        $error = new CheckoutErrorTransfer();

        $checkoutResponse
            ->addError($error)
            ->setIsSuccess(false);

        $mock1 = new MockOrderSaver($checkoutResponse);
        $mock2 = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Plugin\\CheckoutPostSaveHookInterface');
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutWorkflow = new CheckoutWorkflow([], [], [], [$mock1], [$mock2], $omsMock);
        $checkoutRequest = new CheckoutRequestTransfer();

        $mock2->expects($this->never())->method('executeHook');

        $result = $checkoutWorkflow->requestCheckout($checkoutRequest);
        $this->assertEquals($checkoutResponse, $result);
    }

    /**
     * @return void
     */
    public function testPostHookResultIsReturned()
    {
        $checkoutResponse = new CheckoutResponseTransfer();
        $error = new CheckoutErrorTransfer();

        $checkoutResponse
            ->addError($error)
            ->setIsSuccess(true);

        $mock = new MockPostHook($checkoutResponse);
        $omsMock = $this->getMock('Spryker\\Zed\\Checkout\\Dependency\\Facade\\CheckoutToOmsInterface');

        $checkoutWorkflow = new CheckoutWorkflow([], [], [], [], [$mock], $omsMock);
        $checkoutRequest = new CheckoutRequestTransfer();

        $result = $checkoutWorkflow->requestCheckout($checkoutRequest);

        $this->assertEquals($checkoutResponse, $result);
    }

}