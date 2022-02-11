<?php namespace Frukt\Yt\Components;

use Cms\Classes\ComponentBase;
use Google_Client;

/**
 * LastVideos Component
 */
class LastVideos extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'lastVideos Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $client = new Google_Client();
        $client->setApplicationName('API code samples');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.readonly',
        ]);

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
        $client->setAuthConfig('YOUR_CLIENT_SECRET_FILE.json');
        $client->setAccessType('offline');

// Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open this link in your browser:\n%s\n", $authUrl);
        print('Enter verification code: ');
        $authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

// Define service object for making API requests.
        $service = new Google_Service_YouTube($client);

        $queryParams = [
            'mine' => true
        ];

        $response = $service->channels->listChannels('snippet,contentDetails,statistics', $queryParams);
        print_r($response);
    }
}
