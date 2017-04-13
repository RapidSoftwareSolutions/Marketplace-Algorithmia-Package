<?php
$routes = [
    'callAlgorithm',
    'metadata',
    'checkExistence',
    'listDirectoryContents',
    'createDirectory',
    'updateDirectory',
    'deleteDirectory',
    'uploadFile',
    'deleteFile',
    'getFile'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

