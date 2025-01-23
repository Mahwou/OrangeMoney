<?php

namespace Courage\OrangeMoney;

use Courage\OrangeMoney\Exceptions\ErrorRetrievingTransactionStatus;
use Courage\OrangeMoney\Exceptions\PaymentFailedException;

class UssdOrangeMoney
{

    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    /**
     * The $data array should contain the following;
     *
     * amount (required)
     * subscriberMsisdn (required)
     * orderId (optional)
     * notifUrl (optional)
     *
     * @param array $data
     * @return array
     * @throws PaymentFailedException
     */
    public function pay(array $data): array
    {
        $response = $this->api->makePayment($data);

        if (
            !array_key_exists('data', $response) ||
            (isset($response["data"]) && empty($response["data"]))
        ) {
            $msg = $response["message"] ?? "An error occurred while try to process your payment, please try again later.";
            throw new PaymentFailedException($msg);
        }

        $response["data"]["message"] = $response["message"];

        return $response["data"];
    }

    /**
     * @param string $payToken
     * @return array
     * @throws ErrorRetrievingTransactionStatus
     */
    public function checkTransactionStatus(string $payToken): array
    {
        $response = $this->api->checkPaymentStatus($payToken);

        if (
            !array_key_exists('data', $response) ||
            (isset($response()["data"]) && empty($response["data"]))
        ) {
            $msg = $response["message"] ?? "An error occurred while try to retrieve payment status, please try again later.";
            throw new ErrorRetrievingTransactionStatus($msg);
        }

        $response["data"]["message"] = $response["message"];

        return $response['data'];
    }
}
