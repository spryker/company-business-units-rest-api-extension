<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */
namespace Spryker\Zed\Messenger\Business\Model;

use Generated\Shared\Transfer\MessageTransfer;

interface MessageTrayInterface
{

    const FLASH_MESSAGES_SUCCESS = 'flash.messages.success';
    const FLASH_MESSAGES_ERROR= 'flash.messages.error';
    const FLASH_MESSAGES_INFO = 'flash.messages.info';

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $message
     *
     * @return void
     */
    public function addSuccessMessage(MessageTransfer $message);

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $message
     *
     * @return void
     */
    public function addInfoMessage(MessageTransfer $message);

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $message
     *
     * @return void
     */
    public function addErrorMessage(MessageTransfer $message);

    /**
     * @return \Generated\Shared\Transfer\FlashMessagesTransfer
     */
    public function getMessages();

}