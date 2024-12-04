<?php

namespace Courage\OrangeMoney;

use Courage\OrangeMoney\Exceptions\PaymentFailedException;

class OrangeMoney
{

    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

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
}
