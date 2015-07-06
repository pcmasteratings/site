<?php

class RedditAuth extends AAuth
{

    private $authorizeUrl = 'https://ssl.reddit.com/api/v1/authorize';
    private $accessTokenUrl = 'https://ssl.reddit.com/api/v1/access_token';
    private $clientId = 'QedrWwewJGf33A';
    private $clientSecret = 'gCpw3RU7P_DyjMQ-WmEYX-QIoiA';
    private $userAgent = 'ChangeMeClient/0.1 by YourUsername';
    private $redirectUrl = "http://pcmr.darkholme.net/index.php";


    private $client;

    function __construct()
    {
        $this->client = new OAuth2\Client($this->clientId, $this->clientSecret, OAuth2\Client::AUTH_TYPE_AUTHORIZATION_BASIC);
        $this->client->setCurlOption(CURLOPT_USERAGENT, $this->userAgent);
    }

    public function processAuthResponse() {

        try {
            if (isset($_GET["error"])) {
                throw new Exception($_GET["error"]);
            }
            if (isset($_GET["code"]) && isset($_GET["state"])) {
                if ($this->checkForAuthRequestID($_GET["state"])) {
                    $params = array("code" => $_GET["code"], "redirect_uri" => $this->redirectUrl);
                    $response = $this->client->getAccessToken($this->accessTokenUrl, "authorization_code", $params);

                    $accessTokenResult = $response["result"];
                    $this->client->setAccessToken($accessTokenResult["access_token"]);
                    $this->client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

                    $response = $this->client->fetch("https://oauth.reddit.com/api/v1/me.json");

                    $username = $response['result']['name'];
                    $reddit_id = $response['result']['id'];

                    $user = $this->setUser($reddit_id, $username);
                } else {
                    throw new Exception("Auth request ID is invalid");
                }
            }
        } catch(Exception $e) {
            echo("<pre>OAuth Error: " . $e->getMessage() . "\n");
            echo('<a href="auth.php">Retry</a></pre>');
            die;
        }
    }

    public function authenticate()
    {
        $request_id = $this->createAuthRequestID();

        $authUrl = $this->client->getAuthenticationUrl($this->authorizeUrl,
            $this->redirectUrl, array("scope" => "identity", "state" => $request_id));
        header("Location: " . $authUrl);
        die("Redirect");
    }



}
?>