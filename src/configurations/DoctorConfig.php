<?php


namespace App\configurations;


class DoctorConfig
{
    public static function getList(){
        return ["Терапевт"=>"Терапевт",
                "Хирург"=>"Хирург",
                "Эндокринолог"=>"Эндокринолог",
                "Отоларинголог"=>"Отоларинголог",
                "Дерматолог"=>"Дерматолог"
                ];
}
}