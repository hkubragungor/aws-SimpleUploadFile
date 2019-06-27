<?
    session_start();
    require "vendor/autoload.php";
?>

<!DOCTYPE html
<html>
<head>
<meta charset="utf-8">

<style>
body {
  background-color: linen;
}

h4 {
  color: maroon;
  margin-left: 40px;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-left: 40px;

}
</style>
</head>
<body>


<h4>AWS/Upload File</h4>


<?
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
    endif;
?>


<br><br><br>


<form action="upload.php" method="post" enctype="multipart/form-data">

    <input type="file" name="file" />
    <input type="submit" value="Upload"/>
</form>

<br><br><br>

<?php


echo "<h1>Uploaded Files:</h1><br>";
require 'vendor/autoload.php';

$bucket_name = "";
$version = "";
$region = "";
$key = "";
$secret = "";
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$bucket = $bucket_name;

$s3 = new S3Client([
    'version' => $version,
    'region'  => $region,
    'credentials' => [
        'key'    => $key,
        'secret' => $secret
    ]
]);



try {
    $objects = $s3->listObjects([
        'Bucket' => $bucket
    ]);
    foreach ($objects['Contents']  as $object) {

        $addr = $object['Key'].PHP_EOL;
       echo '<a href="https://yoursbucketadress.s3.amazonaws.com/'.$addr.'">'.$addr.'</a>';

       echo "<br>";

    }
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
?>


</body>

</html>
