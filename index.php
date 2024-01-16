<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Remember to always check if a key is set before using it, as context may change depending on where your app is displayed.
if (!empty($_REQUEST) && !empty($_REQUEST['conversation-id'])) {
    $conversationId = $_REQUEST['conversation-id'];

    try {
        // Create a Guzzle client instance
        $client = new Client();

        $baseUrl = $_ENV['SINEOS_BASE_URL'];

        // Make a request to Help Scout API to get conversation details
        $response = $client->get($baseUrl . '/conversations/' . $conversationId, [
            'headers' => [
                // 'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        // Decode the JSON response
        $conversationDetails = json_decode($response->getBody(), true);

        // Handle the conversation details as needed
        // ...

    } catch (RequestException $e) {
        // Handle request exception (e.g., output error message)
        echo 'Error: ' . $e->getMessage();
    }
}
?>
