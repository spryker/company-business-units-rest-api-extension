<?php

namespace Spryker\Zed\Sales\Communication\Controller;

use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\AddressTransfer;
use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Sales\Communication\SalesCommunicationFactory getFactory()
 * @method \Spryker\Zed\Sales\Business\SalesFacade getFacade()
 */
class EditController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function customerAction(Request $request)
    {
        $idOrder = $request->query->getInt('id-sales-order');

        $dataProvider = $this->getFactory()->createCustomerFormDataProvider();
        $form = $this->getFactory()
            ->createCustomerForm(
                $dataProvider->getData($idOrder),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isValid()) {
            $orderTransfer = (new OrderTransfer())->fromArray($form->getData(), true);
            $this->getFacade()->updateOrderCustomer($orderTransfer, $idOrder);

            return $this->redirectResponse(sprintf('/sales/details/?id-sales-order=%d', $idOrder));
        }

        return $this->viewResponse([
            'idOrder' => $idOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function addressAction(Request $request)
    {
        $idOrder = $request->query->getInt('id-sales-order');
        $idOrderAddress = $request->query->getInt('id-address');

        $dataProvider = $this->getFactory()->createAddressFormDataProvider();
        $form = $this->getFactory()
            ->createAddressForm(
                $dataProvider->getData($idOrderAddress),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isValid()) {
            $addressTransfer = (new AddressTransfer())->fromArray($form->getData(), true);
            $this->getFacade()
                ->updateOrderAddress($addressTransfer, $idOrderAddress);

            return $this->redirectResponse(sprintf('/sales/details/?id-sales-order=%d', $idOrder));
        }

        return $this->viewResponse([
            'idOrder' => $idOrder,
            'form' => $form->createView(),
        ]);
    }

}