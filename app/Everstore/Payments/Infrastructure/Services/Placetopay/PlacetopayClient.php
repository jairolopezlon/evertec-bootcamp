<?php

namespace App\Everstore\Payments\Infrastructure\Services\Placetopay;

use App\Everstore\Shared\Domain\Types\Types;
use Carbon\Carbon;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @phpstan-import-type PaymentResponse from Types
 * @phpstan-import-type PlacetoPayAuthData from Types
 * @phpstan-import-type PlacetoPayPaymentOrderData from Types
 */
class PlacetopayClient
{
    public PlacetoPay $placetoPay;

    public function __construct()
    {
        try {
            $login = config('placetopay.login');
            $tranKey = config('placetopay.tranKey');
            $baseUrl = config('placetopay.baseUrl');
            $timeout = config('placetopay.timeout');

            $this->placetoPay = new PlacetoPay([
                'login' => $login,
                'tranKey' => $tranKey,
                'baseUrl' => $baseUrl,
                'timeout' => $timeout,
            ]);
        } catch (PlacetoPayException $e) {
            Log::error('[PAY]: placetoPay instance error '.PlacetoPayException::readException($e));
        }
    }

    /**
     * @return PlacetoPayPaymentOrderData
     */
    public function getPaymentOrderData(
        string $referenceOrderId,
        string $description,
        string $currency,
        float $total,
        string $returnUrl,
        string $ip,
        string $userAgent,
    ): array {
        return [
            'auth' => $this->getAuth(),
            'buyer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'payment' => [
                'reference' => $referenceOrderId,
                'description' => $description,
                'amount' => [
                    'currency' => $currency,
                    'total' => $total,
                ],
            ],
            'expiration' => Carbon::now()->addMinutes(30),
            'returnUrl' => $returnUrl,
            'ipAddress' => $ip,
            'userAgent' => $userAgent,
        ];
    }

    /**
     * @param  PlacetoPayPaymentOrderData  $placetoPayPaymentOrderData
     */
    public function createPaymentOrder(
        $placetoPayPaymentOrderData,
    ): Response {
        $result = Http::post(
            config('placetopay.baseUrl').'/api/session',
            $placetoPayPaymentOrderData
        );

        return $result;
    }

    /**
     * @return PaymentResponse
     */
    public function getPaymentStatus(string $requestId)
    {
        $result = Http::post(
            config('placetopay.baseUrl').'/api/session/'.$requestId,
            [
                'auth' => $this->getAuth(),
            ]
        );

        $paymentResponse = $result->json()['status'];

        return $paymentResponse;
    }

    /**
     * @return PlacetoPayAuthData
     */
    private function getAuth()
    {
        $nonce = Str::random();
        $seed = date('c');

        return [
            'login' => config('placetopay.login'),
            'tranKey' => base64_encode(
                hash(
                    'sha256',
                    $nonce.$seed.config('placetopay.tranKey'),
                    true
                )
            ),
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }
}
