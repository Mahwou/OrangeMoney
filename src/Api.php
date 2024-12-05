<?php

namespace Courage\OrangeMoney;

use Courage\OrangeMoney\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Http;

final class Api
{

    /**
     * Url to get access token
     *
     * @var string
     */
    private string $baseTokenUrl = "https://api-s1.orange.cm/token";
    private string $accessToken;

    /**
     * Url to initialise payment
     *
     * @var string
     */
    private string $baseInitUrl = "https://api-s1.orange.cm/omcoreapis/1.0.2/mp/init";

    /**
     * Url to make payment
     *
     * @var string
     */
    private string $basePayUrl = "https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay";
    private string $pin;
    private string $channelUserMsisdn;
    private string $xAuthToken;
    private string $notifUrl;
    private string $baseCheckPayUrl = "https://api-s1.orange.cm/omcoreapis/1.0.2/mp/paymentstatus/";

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        $userName = config('orange_money_ussd.OM_USERNAME');
        $userPassword = config('orange_money_ussd.OM_PASSWORD');
        $this->pin = config('orange_money_ussd.OM_PIN');
        $this->channelUserMsisdn = config('orange_money_ussd.OM_CHANNEL_USER_MSISDN');
        $this->xAuthToken = config('orange_money_ussd.OM_X_AUTH_TOKEN');
        $this->notifUrl = config('orange_money_ussd.OM_NOTIF_URL');

        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->withToken(base64_encode("$userName:$userPassword"), 'Basic')
            ->asForm()
            ->post($this->baseTokenUrl, ['grant_type' => 'client_credentials']);

        $data = $response->json();

        if (!$response->successful()) {
            throw new AuthenticationException($data['error_description']);
        }
        $this->accessToken = $data['access_token'];
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
     */
    public function makePayment(array $data): array
    {
        $payToken = $this->initPayment();

        $orderId = "OM_0".rand(100000,900000)."_00".rand(10000,90000);

        $defaultData = [
            'pin' => $this->pin,
            'payToken' => $payToken,
            'channelUserMsisdn' => $this->channelUserMsisdn,
            'notifUrl' => $this->notifUrl,
            'amount' => 0,
            'subscriberMsisdn' => "",
            'orderId' => $orderId,
            'description' => "I am paying for this order $orderId",
        ];
        $data = array_merge($defaultData, $data);

        $response = Http::acceptJson()
            ->withHeaders([
                'X-AUTH-TOKEN' => $this->xAuthToken,
                'Content-Type' => 'application/json',
            ])
            ->withToken($this->accessToken)
            ->post($this->basePayUrl, $data);

        return $response->json();
    }

    /**
     * @param string $payToken
     * @return array
     */
    public function checkPaymentStatus(string $payToken): array
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-AUTH-TOKEN' => $this->xAuthToken,
                'Content-Type' => 'application/json',
            ])
            ->withToken($this->accessToken)
            ->get($this->baseCheckPayUrl. $payToken);

        return $response->json();
    }

    private function initPayment(): string
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-AUTH-TOKEN' => $this->xAuthToken,
                'Content-Type' => 'application/json',
            ])
            ->withToken($this->accessToken)
            ->post($this->baseInitUrl);

        return array_key_exists('payToken', $response->json()['data']) ?
            $response->json()['data']['payToken'] : '';
    }
}
