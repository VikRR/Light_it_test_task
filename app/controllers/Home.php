<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 28.02.17
 * Time: 12:10
 */

namespace comm\app\controllers;


use comm\app\core\Controller;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $fb = new Facebook([
            'app_id'                => FB_APP_ID,
            'app_secret'            => FB_APP_SEC,
            'default_graph_version' => 'v2.8',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['public_profile', 'email']; // Optional permissions

        $loginUrl = $helper->getLoginUrl('http://comment.dev/callback', $permissions);

        $_SESSION['link'] = $loginUrl;

        $data['link'] = $loginUrl;

        $this->view->load('home/index', $data);
    }

    public function fbCallback()
    {
        $fb = new Facebook([
            'app_id'                => FB_APP_ID,
            'app_secret'            => FB_APP_SEC,
            'default_graph_version' => 'v2.8',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $_SESSION['FBRLH_state'] = $_GET['state'];

        try {
            $accessToken = $helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(FB_APP_ID);

        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {

                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }
        }

        $_SESSION['fb_access_token'] = (string)$accessToken;

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.

            $response = $fb->get('/me?fields=email,first_name,last_name', $_SESSION['fb_access_token']);

        } catch (\Facebook\Exceptions\FacebookResponseException $e) {

            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {

            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();

        $_SESSION['fb_id'] = (int)$me->getId();

        $data['fb_id'] = $_SESSION['fb_id'];

        $user = $this->model->load('user');

        $check = $user->checkFbId($data);

        foreach ($check as $value) {

            $fb_check = (int)$value;
        }

        if ($fb_check === 0) {
            $data['first_name'] = $me->getFirstName();

            $data['last_name'] = $me->getLastName();

            $data['email'] = $me->getEmail();

            $data['reg_date'] = time();

            $user->setUser($data);
        }

        header('Location: comments');
    }

    public function logout()
    {
        session_destroy();

        header('Location: /');
    }
}