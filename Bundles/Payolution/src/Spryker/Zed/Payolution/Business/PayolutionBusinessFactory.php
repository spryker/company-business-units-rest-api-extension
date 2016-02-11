<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payolution\Business;

use Spryker\Zed\Payolution\Business\Log\TransactionStatusLog;
use Spryker\Zed\Payolution\Business\Api\Converter\Converter;
use Spryker\Zed\Payolution\Business\Order\Saver;
use Spryker\Zed\Payolution\Business\Api\Adapter\Http\Guzzle;
use Spryker\Zed\Payolution\Business\Payment\Handler\Calculation\Calculation;
use Spryker\Zed\Payolution\Business\Payment\Method\Installment\Installment;
use Spryker\Zed\Payolution\Business\Payment\Method\Invoice\Invoice;
use Spryker\Zed\Payolution\Business\Payment\Handler\Transaction\Transaction;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Payolution\Business\Payment\Method\ApiConstants;

/**
 * @method \Spryker\Zed\Payolution\Persistence\PayolutionQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Payolution\PayolutionConfig getConfig()
 */
class PayolutionBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return \Spryker\Zed\Payolution\Business\Payment\Handler\Transaction\TransactionInterface
     */
    public function createPaymentTransactionHandler()
    {
        $paymentTransactionHandler = new Transaction(
            $this->createAdapter($this->getConfig()->getTransactionGatewayUrl(), ApiConstants::TRANSACTION_REQUEST_CONTENT_TYPE),
            $this->createConverter(),
            $this->getQueryContainer(),
            $this->getConfig()
        );

        $paymentTransactionHandler->registerMethodMapper(
            $this->createInvoice()
        );
        $paymentTransactionHandler->registerMethodMapper(
            $this->createInstallment()
        );

        return $paymentTransactionHandler;
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Payment\Handler\Calculation\CalculationInterface
     */
    public function createPaymentCalculationHandler()
    {
        $paymentCalculationHandler = new Calculation(
            $this->createAdapter($this->getConfig()->getCalculationGatewayUrl(), ApiConstants::CALCULATION_REQUEST_CONTENT_TYPE),
            $this->createConverter(),
            $this->getConfig()
        );

        $paymentCalculationHandler->registerMethodMapper(
            $this->createInstallment()
        );

        return $paymentCalculationHandler;
    }

    /**
     * @param string $gatewayUrl
     * @param string $contentType
     *
     * @return \Spryker\Zed\Payolution\Business\Api\Adapter\AdapterInterface
     */
    protected function createAdapter($gatewayUrl, $contentType)
    {
        return new Guzzle($gatewayUrl, $contentType);
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Order\SaverInterface
     */
    public function createOrderSaver()
    {
        return new Saver();
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Api\Converter\ConverterInterface
     */
    public function createConverter()
    {
        return new Converter();
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Log\TransactionStatusLogInterface
     */
    public function createTransactionStatusLog()
    {
        return new TransactionStatusLog($this->getQueryContainer());
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Payment\Method\Invoice\Invoice
     */
    protected function createInvoice()
    {
        return new Invoice($this->getConfig());
    }

    /**
     * @return \Spryker\Zed\Payolution\Business\Payment\Method\Installment\Installment
     */
    protected function createInstallment()
    {
        return new Installment($this->getConfig());
    }

}