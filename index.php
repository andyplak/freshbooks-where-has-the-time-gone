<?php
require('config.php');
require('/lib/FreshBooksRequest.php');
require('model/clients.php');
require('model/projects.php');
require('model/staff.php');
require('model/tasks.php');
require('model/time_entries.php');

// Receive filter values / process with default
// Collect Data
// Display via views


// Setup the login credentials
FreshBooksRequest::init(FB_SUBDOMAIN, TOKEN);

?>
<h2>Clients</h2>

<?php

$clients = new Clients();
if( $client_data = $clients->loadData() ) {
    echo '<ul>';
    foreach( $client_data as $client ) {
        echo '<li>'.$client['organization'].'</li>';
    }
    echo '</ul>';
}else{
    var_dump( $clients->getError() );
}

?>
<h2>Projects</h2>
<?php

$projects = new Projects();
if( $data = $projects->loadData() ) {
    echo '<ul>';
    foreach( $data as $project ) {
        echo '<li>'.$project['name'].'</li>';
    }
    echo '</ul>';
}else{
    var_dump( $projects->getError() );
}

?>
<h2>Staff</h2>
<?php

$staff = new Staff();
if( $data = $staff->loadData() ) {
    echo '<ul>';
    foreach( $data as $member ) {
        echo '<li>'.$member['first_name'].' '.$member['last_name'].'</li>';
    }
    echo '</ul>';
}else{
    var_dump( $staff->getError() );
}

?>
<h2>Tasks</h2>
<?php

$tasks = new Tasks();
if( $data = $tasks->loadData() ) {
    echo '<ul>';
    foreach( $data as $task ) {
        echo '<li>'.$task['name'].'</li>';
    }
    echo '</ul>';
}else{
    var_dump( $tasks->getError() );
}


?>
<h2>Time Logged</h2>
<?php

$time_entries = new TimeEntries();
if( $data = $time_entries->loadData() ) {
    echo '<ul>';
    foreach( $data as $time_entry ) {
        echo '<li>'.$time_entry['date'].' - '.$time_entry['hours'].'</li>';
    }
    echo '</ul>';

    var_dump( $time_entries->getHoursBy('project') );
    var_dump( $time_entries->getHoursBy('staff') );
    var_dump( $time_entries->getHoursBy('task') );
    var_dump( $time_entries->getHoursBy('date') );

}else{
    var_dump( $time_entries->getError() );
}
