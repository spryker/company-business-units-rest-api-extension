<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Shared\ZedRequest\Client;

use Spryker\Shared\Transfer\TransferInterface;

interface ResponseInterface
{

    const INFO_MESSAGES = 'infoMessages';
    const ERROR_MESSAGES = 'errorMessages';
    const SUCCESS_MESSAGES = 'successMessages';
    const SUCCESS = 'success';
    const TRANSFER_CLASSNAME = 'transferClassName';
    const TRANSFER = 'transfer';

    /**
     * @param array $values
     */
    public function fromArray(array $values);

    /**
     * @return \Spryker\Shared\ZedRequest\Client\Message[]
     */
    public function getErrorMessages();

    /**
     * @param string $messageString
     *
     * @return bool
     */
    public function hasErrorMessage($messageString);

    /**
     * @param array $errorMessages
     *
     * @return $this
     */
    public function addErrorMessages(array $errorMessages);

    /**
     * @param \Spryker\Shared\ZedRequest\Client\Message $errorMessage
     *
     * @return $this
     */
    public function addErrorMessage(Message $errorMessage);

    /**
     * @return \Spryker\Shared\ZedRequest\Client\Message[]
     */
    public function getInfoMessages();

    /**
     * @param string $messageString
     *
     * @return bool
     */
    public function hasInfoMessage($messageString);

    /**
     * @param \Spryker\Shared\ZedRequest\Client\Message $message
     *
     * @return $this
     */
    public function addInfoMessage(Message $message);

    /**
     * @param array $messages
     *
     * @return $this
     */
    public function addInfoMessages(array $messages);

    /**
     * @return \Spryker\Shared\ZedRequest\Client\Message[]
     */
    public function getSuccessMessages();

    /**
     * @param string $messageString
     *
     * @return bool
     */
    public function hasSuccessMessage($messageString);

    /**
     * @param array $successMessages
     *
     * @return $this
     */
    public function addSuccessMessages(array $successMessages);

    /**
     * @param \Spryker\Shared\ZedRequest\Client\Message $successMessage
     *
     * @return $this
     */
    public function addSuccessMessage(Message $successMessage);

    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @param bool $success
     *
     * @return $this
     */
    public function setSuccess($success);

    /**
     * @return \Spryker\Shared\Transfer\TransferInterface
     */
    public function getTransfer();

    /**
     * @param \Spryker\Shared\Transfer\TransferInterface $transferObject
     *
     * @return $this
     */
    public function setTransfer(TransferInterface $transferObject);

}