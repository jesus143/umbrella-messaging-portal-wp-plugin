<?php
require_once("class-ump-fd.php");

$fd = new Ump\UmpFd();


// get all the tickets
$tickets = $fd::fetchTickets('email', 'mrjesuserwinsuarez@gmail.com', 5, 1);

echo "<pre>";

foreach($tickets as $ticket) {

    $subject     = $ticket['subject'];
    $description = $ticket['description_text'];
    $ticketId    = $ticket['id'];

    echo "<br>Subject " . $subject;
    echo "<br>Description " . $description;

    $replies = $fd::getUserTicketReplies($ticketId);

    print_r($replies);

    print "<hr>";
}