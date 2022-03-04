<?php
if (!function_exists('vars')){
    function vars($fileName)
    {
        $file = resource_path('vars/'.$fileName.'.json');
        if (file_exists($file)){
            return json_decode(file_get_contents($file));
        }
        return false;
    }
}
if (!function_exists('moneyFormat')) {

    function moneyFormat($money, $icon = false)
    {
        if (strlen($money) == 0)
            $money = 0;
        $eksi = ($money < 0);
        if ($eksi)
            $money = $money * -1;
        $kusuratli = $money;
        $kusuratli = explode(".", $kusuratli);
        $sol = $kusuratli[0];
        @$sag = $kusuratli[1];
        if (strlen($sag) > 2) {
            $sag = substr($sag, 0, 2);
        }
        $sag = $sag . (strlen($sag) == 1 ? "0" : "");
        $ters = strrev($sol);
        $dizi = strrev(implode(".", str_split($ters, 3)));
        $sayi = ($dizi . ($sag != null ? "," . $sag : ""));
        if (strpos($sayi, ",") === false)
            $sayi = $sayi . ",00";
        $sayi = ($eksi ? "-" : "") . $sayi;

        $sayi = $sayi . ($icon ? ' ₺' : '');
        return $sayi;
    }
}
