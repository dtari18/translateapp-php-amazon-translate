<?php
require 'vendor/autoload.php';
use Aws\Translate\TranslateClient; 
use Aws\Exception\AwsException;
if(isset($_POST['translate'])){
$textToTranslate = $_POST['txtid'];

//Konfigurasi Credentials dari AWS Educate.
define('REGION','us-east-1');
define('VERSION','latest');
define('PROFILE','default');
define('ACCESSKEY_ID','ASIASQERICG6ICECGXPV');
define('SECRET_KEY','g2Jf4uGTmtM5VcYE72ht3TL9Hcn7U+DFVWPK2MOf');
define('TOKEN','IQoJb3JpZ2luX2VjEMz//////////wEaCXVzLXdlc3QtMiJGMEQCICOhhsLKSLV/e54opxFSHawwBnLCau6g0e4iEFrZt1XKAiAe5f+BZLlpFDgYHzU0iqcncm8FBWNz61vRacV7/2MPEiqvAgh1EAAaDDE3MjEwMzMwNzcwOCIMgXEYB+Dy9AxaINjGKowCNo+pk6u15HADqyEaH+Xh9wyehbho2Zz8qI5aaIyLTh4ZA5LKc2W9k8S8Al/aamm2Owb27rXvCBRSSG3AqTHpVe2mxSdWNh6sjpbirCkQZhDo90lFSu6v97FTNuGYHmyGKVVUlf6FvjcBgHTSx62AGOI/10VOHXuYfIA8F2sfSCTiw7MPHWXgEuqW2/Re4231i/jOptCt4FjNujqQHn/yiBZy9pJ/KMAE2m8mLO8xc2ic3JdtH3384FlrxG+OMWEnE2Ryezn7A4KHofvYzH/joBPagS/mVau1JJynKNu8LydVmPmu5sM7Kc81XWEQMvV/DXvL+/goQvz9T0xTCzI2WyFCy3gctlWSWR/ZmDD73siFBjqeAQLnlaUV+QxA3TVkWCHlBll7GH7Y3av5GIfW3eOvIYivFm3yJ11hjH0vxOu2V6Srf1DbrfdL+/jxWH5I/fLjBk81euZkd2ImErtxIDi4UCJlYjB6w8Y54AZMsabQxzVjXd8eIIWBcMUKDCbnoXeO7aYuDmEhdtq9mopt+n0CAeT5TQ7sjdtWkwoMF5GTPLruPg06PdG16AdKu0EJ4zPe');
$client = new Aws\Translate\TranslateClient([
    'region' => REGION,
    'version' => VERSION,
    'credentials' => [ 
        'profile' => PROFILE,
                'key'    => ACCESSKEY_ID,
                'secret' => SECRET_KEY,
                'token' => TOKEN
    ]
]);

$currentLanguage = 'id';
$targetLanguage= 'en';

try {
    $result = $client->translateText([
        'SourceLanguageCode' => $currentLanguage,
        'TargetLanguageCode' => $targetLanguage, 
        'Text' => $textToTranslate, 
    ]);
    $hasil = $result['TranslatedText'];
}catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Aplikasi Web Translate ID-EN ala DwiAY dengan layanan Amazon Translate" />
        <meta name="author" content="DwiAY.com" />
        <title>Aplikasi Web Translate ID-EN ala DwiAY</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <section id="body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <h2 align="center">Aplikasi Web Translate Indonesia - Inggris Sederhana dengan Amazon Translate</h2>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Indonesia</label>
    <?php
    if($textToTranslate == null || $textToTranslate == ""){
        $txtid = "";
    }else{
        $txtid = $textToTranslate;
    }
    ?>
    <input type="text" name="txtid" class="form-control" value="<?php echo $txtid; ?>" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Inggris</label>
    <?php
    if($hasil == null || $hasil == ""){
        $txten = "";
    }else{
        $txten = $hasil;
    }
    ?>
    <input type="text" name="txten" class="form-control" value="<?php echo $txten; ?>" id="exampleInputPassword1">
    <input type="hidden" name="translate" value="translate">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
    </body>
</html>
