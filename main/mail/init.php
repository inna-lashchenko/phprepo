<?php
session_start();

require_once('../../vendor/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '1734936170162588',
    'app_secret' => 'b3af21a7c32756d59bb6e4c9011a9f70',
    'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;

    $fb->setDefaultAccessToken($accessToken);
    try {
        $response = $fb->get('/me');
        $userNode = $response->getGraphUser();
        $_SESSION['facebook_user_name'] = (string) $userNode->getName();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

//    echo $accessToken;

    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}
//echo 'Logged in as ' . $userNode->getName();
    header('Location: /../../index.php');