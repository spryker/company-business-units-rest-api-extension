<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payolution\Communication\Controller;

use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \Spryker\Zed\Payolution\Communication\PayolutionCommunicationFactory getFactory()
 * @method \Spryker\Zed\Payolution\Persistence\PayolutionQueryContainerInterface getQueryContainer()
 */
class DetailsController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $idPayment = (int) $request->get('id-payment');
        $paymentEntity = $this->getPaymentEntity($idPayment);
        $requestLogTable = $this->getFactory()->createRequestLogTable($idPayment);
        $statusLogTable = $this->getFactory()->createStatusLogTable($idPayment);

        return [
            'idPayment' => $idPayment,
            'paymentDetails' => $paymentEntity,
            'requestLogTable' => $requestLogTable->render(),
            'statusLogTable' => $statusLogTable->render(),
        ];
    }

    /**
     * @param int $idPayment
     *
     * @return \Orm\Zed\Payolution\Persistence\SpyPaymentPayolution
     */
    private function getPaymentEntity($idPayment)
    {
        $paymentEntity = $this->getQueryContainer()->queryPaymentById($idPayment)->findOne();

        if ($paymentEntity === null) {
            throw new NotFoundHttpException('Payment entity could not be found');
        }

        return $paymentEntity;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function requestLogTableAction(Request $request)
    {
        $idPayment = (int) $request->get('id-payment');
        $requestLogTable = $this->getFactory()->createRequestLogTable($idPayment);

        return $this->jsonResponse($requestLogTable->fetchData());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function statusLogTableAction(Request $request)
    {
        $idPayment = (int) $request->get('id-payment');
        $statusLogTable = $this->getFactory()->createStatusLogTable($idPayment);

        return $this->jsonResponse($statusLogTable->fetchData());
    }

}