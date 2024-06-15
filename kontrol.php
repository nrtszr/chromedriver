<?php
function getChromedriverURLForWin64() {
    // JSON verilerinin bulunduğu URL
    $url = 'https://googlechromelabs.github.io/chrome-for-testing/last-known-good-versions-with-downloads.json';

    // cURL oturumu başlat
    $ch = curl_init();

    // cURL seçeneklerini ayarla
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // HTTP isteğini yap ve yanıtı al
    $jsonOutput = curl_exec($ch);

    // cURL oturumunu kapat
    curl_close($ch);

    // JSON verisini bir diziye dönüştür
    $data = json_decode($jsonOutput, true);

    // "Stable" kanalındaki "chromedriver" için "win64" platformunun URL'sini bul

    // "Stable" kanalındaki sürüm numarasını al
    $version = $data['channels']['Stable']['version'];

    // Sürüm numarasını noktalara göre parçala ve ilk parçayı döndür
    $parts = explode('.', $version);
    $guncel_versiyon =  $parts[0];
    //echo '<hr>';
    $chromedriver = $data['channels']['Stable']['downloads']['chromedriver'];
    foreach ($chromedriver as $driver) {
        if ($driver['platform'] == 'win64') {
            //return 'Versiyon: '.$guncel_versiyon.'<br>Url: '.$driver['url'];
            return (int)$guncel_versiyon;
        }
    }

    // Eğer platform bulunamazsa null döndür
    return null;
}

$win64ChromedriverURL = getChromedriverURLForWin64();

if ($win64ChromedriverURL) {
//    echo $win64ChromedriverURL;
    if($win64ChromedriverURL==126)
    { echo 'Güncel';}
    else
    { echo 'Güncelle';}
} else {
    echo 'Chromedriver win64 URL bulunamadı.';
}
?>
