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
define('ACCESSKEY_ID','Masukkan Kode Access Key ID');
define('SECRET_KEY','Masukkan Kode Secret Key');
define('TOKEN','Masukkan kode Access Token');
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
