<?php

namespace App\Services;

class BdCourierFraudService
{
    public static function checkPhone(string $phone)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://bdcourier.com/api/courier-check",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                "phone" => $phone
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . env('BDCOURIER_TOKEN'),
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 15,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
