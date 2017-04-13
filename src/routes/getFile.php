<?php

$app->post('/api/Algorithmia/getFile', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','connector', 'path']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $apiKey = $post_data['args']['apiKey'];
    $connector = $post_data['args']['connector'];
    $path = $post_data['args']['path'];
    $query_str = $settings['api_data_url'] . "/$connector/$path";


    $client = $this->httpClient;

    try {
        $resp = $client->get($query_str, [
            'headers' => [
                'Authorization' => $apiKey,
            ],
        ]);
        $responseBody = $resp->getBody()->getContents();

        if ($resp->getStatusCode() == 200) {
            $size = $resp->getHeader('Content-Length')[0];
            $contentDisposition = $resp->getHeader('Content-Disposition')[0];
            $contentDisposition = str_replace("attachment", "", $contentDisposition);
            $contentDisposition = str_replace('filename=', "", $contentDisposition);
            $contentDisposition = str_replace(';', "", $contentDisposition);
            $uploadServiceResponse = $client->post($settings['uploadServiceUrl'], [
                'multipart' => [
                    [
                        "name" => "file",
                        "filename" => trim($contentDisposition),
                        "contents" => $responseBody
                    ],
                    [
                        'name' => 'length',
                        'contents' => $size
                    ]
                ]
            ]);
            $uploadServiceResponseBody = $uploadServiceResponse->getBody()->getContents();
            if ($uploadServiceResponse->getStatusCode() == 200) {
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = json_decode($uploadServiceResponse->getBody());
            }
            else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($uploadServiceResponseBody) ? $uploadServiceResponseBody : json_decode($uploadServiceResponseBody);
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($exception->getResponse()->getBody());
    }
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});