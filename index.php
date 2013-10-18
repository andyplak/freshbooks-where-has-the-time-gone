<?php
require('config.php');
require('lib/FreshBooksRequest.php');



// Receive filter values / process with default
// Collect Data
// Display via views




// Setup the login credentials
FreshBooksRequest::init(FB_SUBDOMAIN, TOKEN);

/**********************************************
 * Fetch all active clients
 **********************************************/
$fb = new FreshBooksRequest('client.list');
$fb->post(array(
    'folder' => 'active'
));
$fb->request();
if($fb->success())
{
    echo '<p>Clients</p><ul>';
    $response = $fb->getResponse();
    $clients = $response['clients']['client'];
    foreach($clients as $client) {
       echo '<li>'.$client['organization'].'</li>';
    }
    echo '</ul>';
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}

/**********************************************
 * Fetch all active projects
 **********************************************/
$fb = new FreshBooksRequest('project.list');
$fb->request();
if($fb->success())
{
    //echo '<p>Projects</p><ul>';
    $response = $fb->getResponse();
    $projects = $response['projects']['project'];
    foreach($projects as $project) {
        echo '<li>'.$project['name'].'</li>';
    }
    echo '</ul>';
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}

$fb = new FreshBooksRequest('time_entry.list');
$fb->post(array(
    'date_from' => '2013-09-01',
    'date_to' => '2013-09-30',
    'per_page' => 100
));
$fb->request();
if($fb->success())
{
    $response = $fb->getResponse();
var_dump($response['time_entries']['@attributes']);
    $time_entries = $response['time_entries']['time_entry'];
    foreach($time_entries as $time_entry) {
        echo '<li>'.$time_entry['date'].' - '.$time_entry['hours'].'</li>';
    }
    echo '</ul>';
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}



/**********************************************
 * List invoices from a specific client
 **********************************************/
/*
$fb = new FreshBooksRequest('invoice.list');
$fb->post(array(
    'client_id' => 41
));
$fb->request();
if($fb->success())
{
    var_dump($fb->getResponse());
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}
*/

?>