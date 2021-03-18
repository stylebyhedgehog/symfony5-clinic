<?php


namespace App\configurations;


class MedicalCartConfig
{
    public static function getCartStatus(){
        return [
            "awaiting_verification",
            "verified"
        ];
}
    public static function getCartType(){
        return [
            "attached"

        ];
    }
    public static function getPaymentType(){
        return [
            "attached"

        ];
    }
}