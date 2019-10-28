<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Nexmo\Client\Exception\Request;
use Nexmo\Client\Exception\Server;
use Nexmo\Conversations\Conversation;
use Nexmo\Conversations\Filter;

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

/** @var Conversations $entry */
foreach ($client->conversation() as $entry) {
    try {
        $isDeleted = $client->conversation()->delete($entry);
    } catch (Server $ex) {
        error_log($ex->getMessage());
        exit(1);
    } catch (Request $ex) {
        error_log($ex->getMessage());
        exit(1);
    }
    
    if ($isDeleted) {
        error_log($entry->getId() . ' has been deleted');
    } else {
        error_log($entry->getId() . ' could not be deleted');
    }
    break;
}