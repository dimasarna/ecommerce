<?php

namespace Omnipay\Midtrans\Message;

class NotificationRequest extends AbstractRequest
{
    public function getData()
    {
        if (0 === strpos($this->httpRequest->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($this->httpRequest->getContent(), true);
            $this->httpRequest->request->replace(is_array($data) ? $data : array());
        }

        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        $responseData = $this->httpClient
            ->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $data['order_id'] . '/status', $this->getSendDataHeader())
            ->getBody()
            ->getContents();

        return new NotificationResponse(
            $this, $responseData
        );
    }

    protected function getSendDataHeader()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getServerKey() . ':')
        ];
    }
}