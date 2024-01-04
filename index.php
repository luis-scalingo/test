<?php

// Include the AWS SDK using the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\Credentials\CredentialProvider;

$mybucket = 'lpi-demo-bucket';
$key = 'lake.png';

echo '<h1> Hello World test </h1>';

try {
    //Create a S3Client

    if (!getenv("AWS_ACCESS_KEY_ID")) {
        //use credentials file
        $s3Client = new S3Client([
            'profile' => 'scalingo-key',
            'region' => 'eu-central-1'
        ]);
    }else{
        //use env variables
        $s3Client = new S3Client([
            'region' => 'eu-central-1',
            'version' => '2006-03-01',
            'credentials' => CredentialProvider::env()
        ]);
    }

    echo "<h3>Successful connection</h3>";

    // Save object to a file.
    $result = $s3Client->getObject(array(
        'Bucket' => $mybucket,
        'Key' => $key,
        'SaveAs' => $key
    ));

    echo "<p><img src='$key'></p>";

} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
