<?php

class OAuthLibrary {
    private $clientId;
    private $clientSecret;
    private $tokenUrl;
    private $redirectUri;

    public function __construct($clientId, $clientSecret, $tokenUrl, $redirectUri) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tokenUrl = $tokenUrl;
        $this->redirectUri = $redirectUri;
    }

    public function authenticate($username, $password) {
        $postData = [
            'clientId' => $this->clientId,
            'username' => $username,
            'password' => $password,
        ];

        $ch = curl_init($this->tokenUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['error']) && $data['error_code'] !== 0) {
            return ['success' => false, 'message' => 'Login failed. Please check your credentials.'];
        }

        // Save access token and account ID
        return [
            'success' => true,
            'accessToken' => $data['accessToken'],
            'accountId' => $data['accountId'],
        ];
    }
}
