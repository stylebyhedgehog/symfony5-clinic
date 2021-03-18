<?php


namespace App\configurations;


class MedicalCartConfig
{
    public static  $status_await="На рассмотрении";
    public static  $status_ok="Подтверждена";

    public static function getCartType(){
        return [
            "Прикрепленный"=>"Прикрепленный",
            "Направление из другого ЛПУ"=>"Направление из другого ЛПУ",
            "Оказание разовой платной услуги"=>"Оказание разовой платной услуги"

        ];
    }

}