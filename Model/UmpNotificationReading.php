<?php

namespace Ump;

use APP\WPDB_QUERIES;


class UmpNotificationReading extends WPDB_QUERIES{

    private $tableName = 'wp_ump_notification_reading';

    function __construct( )
    {
        parent::__construct( $this->tableName );
    }

    /**
     * @param $user_id
     * @param $ticket_id
     * @param $reply_id
     * @return array|bool|null|object
     */
    public function queryData($user_id, $ticket_id, $reply_id)
    {
        global $wpdb;
        return $wpdb->get_results(" SELECT * FROM $this->tableName WHERE user_id = $user_id AND ticket_id = '$ticket_id'  AND reply_id = '$reply_id'", ARRAY_A);
    }

    /**
     * @param $user_id
     * @param $ticket_id
     * @return bool
     */
    public function deleteEntry($user_id, $ticket_id)
    {
        //$ticketId = "$ticket_id";
        return $this->wpdb_delete(['user_id'=>$user_id, 'ticket_id'=>"$ticket_id"]);
    }

    /**
     * @param $user_id
     * @param $ticket_id
     * @param $reply_id
     */
    public function insertEntry($user_id, $ticket_id, $reply_id)
    {
        $this->wpdb_insert(array('user_id'=>$user_id, 'ticket_id'=>"$ticket_id", 'reply_id'=>"$reply_id"));
    }

    public function updateStatusToRead($user_id, $ticket_id, $reply_id)
    {
      return   $this->wpdb_update(array('status'=>'read'), array('user_id'=>$user_id, 'ticket_id'=>"$ticket_id", 'reply_id'=>"$reply_id"));
    }

    public function processNotificationData($user_id, $ticket_id, $reply_id)
    {
        global $wpdb;
        $entryData = $this->queryData($user_id, $ticket_id, $reply_id);
        if($entryData) {
            return $entryData[0]['status'];
        } else {

            if($this->deleteEntry($user_id, $ticket_id)) {
                $this->insertEntry($user_id, $ticket_id, $reply_id);
                $entryData = $this->queryData($user_id, $ticket_id, $reply_id);
                return $entryData[0]['status'];
            } else {
                print "Ohps!, something wrong! can't delete.";
                return false;
            }

        }
    }
}