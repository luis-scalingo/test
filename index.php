<?php

// Include the AWS SDK using the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'myscalingobucket';
$key = 'horse.png';

echo '<h1> Hello World test </h1>';

try {
    //Create a S3Client
    $s3Client = new S3Client([
        'profile' => 'default',
        'region' => 'eu-west-3',
        'version' => '2006-03-01'
    ]);

    // Save object to a file.
    $result = $s3Client->getObject(array(
        'Bucket' => $bucket,
        'Key' => $key,
        'SaveAs' => $key
    ));

    echo "<img src='$key'>";

} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
