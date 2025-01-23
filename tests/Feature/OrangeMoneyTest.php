<?php

use Courage\OrangeMoney\Exceptions\ErrorRetrievingTransactionStatus;
use Courage\OrangeMoney\UssdOrangeMoney;

test("payment can be made", function () {
    $om = new UssdOrangeMoney();

    $response = makeOrangePayment($om);

    $this->assertArrayHasKey('payToken', $response);
});

/**
 * @throws ErrorRetrievingTransactionStatus
 */
test("payment can be verified", function () {
    $om = new UssdOrangeMoney();

    $response = makeOrangePayment($om);

    $response = $om->checkTransactionStatus($response['payToken']);

    $this->assertArrayHasKey('status', $response);
});

/**
 * @param UssdOrangeMoney $om
 * @return array
 */
function makeOrangePayment(UssdOrangeMoney $om): array
{
    $data = [
        'orderId' => "order1234",
        'amount' => "1",
        'subscriberMsisdn' => "699999999",
    ];
    return $om->pay($data);
}
