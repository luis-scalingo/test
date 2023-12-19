<?php

// Include the AWS SDK using the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$mybucket = 'myscalingobucket';
$key = 'horse.png';

echo '<h1> Hello World test </h1>';

try {
    //Create a S3Client

    if (!getenv("AWS_ACCESS_KEY_ID")) {
        //use credentials file
        $s3Client = new S3Client([
            'profile' => 'default',
            'region' => 'eu-west-3',
            'version' => '2006-03-01'
        ]);
    }else{
        //use env variables
        $s3Client = new S3Client([
            'region' => 'eu-west-3',
            'version' => '2006-03-01',
            'credentials' => [
                'key' => getenv("AWS_ACCESS_KEY_ID"),
                'secret'  => getenv("AWS_SECRET_ACCESS_KEY"),
            ],
        ]);
    }

    echo "<h3>Successful connection</h3>";

    echo "<p>Bucket list</p>";

    //Listing all S3 Bucket
    $buckets = $s3Client->listBuckets();
    foreach ($buckets['Buckets'] as $bucket) {
        echo $bucket['Name'] . "\n";
    }

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
