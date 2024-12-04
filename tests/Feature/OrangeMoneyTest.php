<?php

use Courage\OrangeMoney\OrangeMoney;

test("payment can be made", function () {
    $om = new OrangeMoney();

    $response = makeOrangePayment($om);

    $this->assertArrayHasKey('payToken', $response);
});


test("payment can be verified", function () {
    $om = new OrangeMoney();

    $response = makeOrangePayment($om);

    $response = $om->checkTransactionStatus($response['payToken']);

    $this->assertArrayHasKey('status', $response);
});

/**
 * @param OrangeMoney $om
 * @return array
 */
function makeOrangePayment(OrangeMoney $om): array
{
    $data = [
        'orderId' => "order1234",
        'amount' => "1",
        'subscriberMsisdn' => "699999999",
    ];
    return $om->pay($data);
}
