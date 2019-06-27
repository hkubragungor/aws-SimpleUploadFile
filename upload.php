<?php

    define(ACCESS_KEY, "");
    define(SECRET_KEY, "");
    session_start();
    $key = "";
    $secret = "";
    $version = "";
    $region = "";
    $bucket_name = "";
    require "vendor/autoload.php";
    use Aws\S3\S3Client;
    try {

        // dispara excessão caso não tenha dados enviados
        if (!isset($_FILES['file'])) {
            throw new Exception("File not uploaded", 1);
        }
        else{
        // cria o objeto do cliente, necessita passar as credenciais da AWS
        $clientS3 = S3Client::factory(array(
    'version' => $version,
    'region'  => $region,
    'credentials' => [
        'key'    => $key,
        'secret' => $secret
    ]
));

echo $_FILES['file']['name'];


        // método putObject envia os dados pro bucket selecionado (no caso, teste-marcelo
        $response = $clientS3->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $_FILES['file']['name'],
            'SourceFile' => $_FILES['file']['tmp_name'],
        ));

}
   $_SESSION['msg'] = "<a href='{$response['ObjectURL']}'>{$response['ObjectURL']}$
        header("location: index.php");
    } catch(Exception $e) {
        echo "Erro > {$e->getMessage()}";
    }

?>
