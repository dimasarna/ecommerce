<?php

namespace Omnipay\Midtrans\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

class NotificationResponse extends AbstractResponse implements NotificationInterface
{
    protected $message;

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if (!is_array($data)) {
            $this->data = json_decode($data, true);
        }

    }

    public function isPending()
    {
        return !$this->isSuccessful();
    }

    public function isSuccessful()
    {
        return $this->isValidSignatureKey() && $this->isValidFields();
    }

    public function getTransactionReference()
    {
        return $this->data('transaction_id');
    }

    public function getTransactionStatus()
    {
        if ($this->isSuccessful()) return NotificationInterface::STATUS_COMPLETED;
        elseif ($this->isPending()) return NotificationInterface::STATUS_PENDING;
        else return NotificationInterface::STATUS_FAILED;
    }

    private function isValidSignatureKey()
    {
        $orderId = $this->data('order_id');
        $statusCode = $this->data('status_code');
        $grossAmount = $this->data('gross_amount');
        $serverKey = $this->getRequest()->getServerKey();
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');
        $result = ($signature === $this->data('signature_key'));

        if (!$result) {
            $this->message = 'invalid signature key';
        }

        return $result;
    }

    private function isValidFields()
    {
        $result =
            intval($this->data('status_code')) == 200 &&
            in_array(strtolower($this->data('transaction_status')), ['settlement', 'capture']);

        if ($fraudStatus = $this->data('fraud_status')) {
            $result = $result && strtolower($fraudStatus) == 'accept';
        }

        if (!$result) {
            $this->message = 'invalid fields';
        }

        return $result;
    }

    private function data($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : '';
    }

    public function getMessage()
    {
        return $this->message;
    }
}