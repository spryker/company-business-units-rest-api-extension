<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Client\Cart\Session;

use Generated\Shared\Transfer\CartTransfer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSession implements CartSessionInterface
{

    const CART_SESSION_IDENTIFIER = 'cart session identifier';
    const CART_SESSION_ITEM_COUNT_IDENTIFIER = 'cart item count session identifier';

    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    private $session;

    /**
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return \Generated\Shared\Transfer\CartTransfer
     */
    public function getCart()
    {
        $cartTransfer = new CartTransfer();

        if ($this->session->has(self::CART_SESSION_IDENTIFIER)) {
            return $this->session->get(self::CART_SESSION_IDENTIFIER, $cartTransfer);
        }

        return $cartTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CartTransfer $cartTransfer
     *
     * @return $this
     */
    public function setCart(CartTransfer $cartTransfer)
    {
        $this->session->set(self::CART_SESSION_IDENTIFIER, $cartTransfer);

        return $this;
    }

    /**
     * @return int
     */
    public function getItemCount()
    {
        if (!$this->session->has(self::CART_SESSION_ITEM_COUNT_IDENTIFIER)) {
            return 0;
        }

        return $this->session->get(self::CART_SESSION_ITEM_COUNT_IDENTIFIER);
    }

    /**
     * @param int $itemCount
     *
     * @return $this
     */
    public function setItemCount($itemCount)
    {
        $this->session->set(self::CART_SESSION_ITEM_COUNT_IDENTIFIER, $itemCount);

        return $this;
    }

}