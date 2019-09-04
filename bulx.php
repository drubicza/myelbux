<?php
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

require("config.php");

/* START COLOR */
$res     = "\033[0m";
$hitam   = "\033[0;30m";
$abu2    = "\033[1;30m";
$putih   = "\033[0;37m";
$putih2  = "\033[1;37m";
$red     = "\033[0;31m";
$red2    = "\033[1;31m";
$green   = "\033[0;32m";
$green2  = "\033[1;32m";
$yellow  = "\033[0;33m";
$yellow2 = "\033[1;33m";
$blue    = "\033[0;34m";
$blue2   = "\033[1;34m";
$purple  = "\033[0;35m";
$purple2 = "\033[1;35m";
$lblue   = "\033[0;36m";
$lblue2  = "\033[1;36m";
/* END COLOR */

$false   = "{$abu2}[{$red}x{$abu2}]{$red2}";
$true    = "{$abu2}[{$green}+{$abu2}]{$green2}";
$pentung = "{$abu2}[{$yellow}!{$abu2}]{$yellow2}";
$titik   = "{$abu2}[{$res}•{$abu2}]{$green2}";


$banner = "\r{$purple}       __       _       __
      / /__    (_)___ _/ /______ _
 __  / / _ \  / / __ `/ //_/ __ `/
/ /_/ /  __/ / / /_/ / ,< / /_/ /
\____/\___/_/ /\__,_/_/|_|\__,_/
         /___/
{$green}=========================================================
{$green2}Author By {$abu2} :{$res} Kadal15
{$green2}Channel Yt{$abu2} :{$res} Jejaka Tutorial\n";

echo $banner;

function curl($url,$headers,$data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function get($url,$headers)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function password()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://jejakainc.com/Password/Passw.txt");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($ch);
    echo "\033[1;33mSilahkan Kunjungi Link Di Bawah Ini Untuk Mengambil Password\n\033[1;0mhttp://jejakainc.com/Password/\n\n\n";
    $i = 0;

    while (True){
        echo "\033[1;32mEnter Password \033[1;30m:\033[1;0m ";
        $passw = trim(fgets(STDIN));

        if ($passw == $result) {
            echo "";
            break;
        } else {
            $i++;
            echo "\033[1;31mWrong Password.......!\n";
            sleep(1);
            if ($i > 2) {
                echo "\033[1;33mSilahkan Kunjungi Link Di Bawah Ini Untuk Mengambil Password\n\033[1;0mhttp://jejakainc.com/Password/Passw.txt\n\n\n";
                exit();
            }
        }
    }
}

$ua = array(
"Sec-Fetch-Mode: cors",
"Origin: http://localhost",
"Authorization: ".$token,
"User-Agent: Mozilla/5.0 (Linux; Android 9; Redmi 7 Build/PKQ1.181021.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/76.0.3809.89 Mobile Safari/537.36",
"Content-Type: application/json",
"Accept: */*",
"X-Requested-With: com.myelbux.chat",
"Sec-Fetch-Site: cross-site",
"Referer: http://localhost/home",
"Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7"
);

password();

while (true) {
    $js  = json_decode(get("https://www.myelbux.com/api/coupons",$ua));
    $jsn = json_decode(curl("https://www.myelbux.com/api/coupon/claim",$ua,json_encode(array("id"=>$js->id),true)),true);

    if ($jsn["message"] == null) {
        echo "{$false} Error : Cannot Login\n";
        exit();
    }

    echo "{$titik} Messages {$abu2}:{$res} ".$jsn["message"]."\n";

    if ($jsn["user"] == true) {
        echo "{$true} Balance BCH {$abu2}:{$res} ".$jsn["user"]["wallets"][0]["total"]."\n";
        echo "{$true} Balance ETH {$abu2}:{$res} ".$jsn["user"]["wallets"][1]["total"]."\n";
        echo "{$true} Balance LTC {$abu2}:{$res} ".$jsn["user"]["wallets"][2]["total"]."\n";
    }

    for ($minute = 89; $minute >- 1; $minute--) {
        for ($second1 = 5; $second1 >- 1; $second1--) {
            for ($second2 = 9; $second2 >- 1; $second2--) {
                echo "\r{$pentung} Next Claim On {$res}".$minute.":".$second1.$second2." {$yellow2}Again";
                sleep(1);
            }
        }
    }
    echo "\r                                                     \r";
}
?>
