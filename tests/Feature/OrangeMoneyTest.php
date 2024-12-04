<?php

use Courage\OrangeMoney\OrangeMoney;

test("payment can be made", function () {
    $om = new OrangeMoney();

    $data = [
        'orderId' => "order1234",
        'amount' => "1",
        'subscriberMsisdn' => "699999999",
    ];

    $response = $om->pay($data);

    $this->assertArrayHasKey('payToken', $response);
});
