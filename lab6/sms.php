<?php

interface NotificationInterface
{
    public function setData($data);
    public function sendNotification();
}

class twitterService
{
    public function setMessage($text)
    {
        $this->_data['message'] = $text;
        echo $this->_data['message'] . PHP_EOL;
    }

    public function sendTweet()
    {
        echo "I sent a tweet \n";
    }
}

class SmsService {
    private $_data = []; 

    public function setRecipient($recipient) {
        $this->_data['recipient'] = $recipient;
    }

    public function setMessage($message) {
        $this->_data['message'] = $message;
    }

    public function setScheduledTime($time) {
        $this->_data['scheduled_time'] = $time;
    }

    public function sendText() {
        $recipient = $this->_data['recipient'];
        $message = $this->_data['message'];
        $scheduledTime = isset($this->_data['scheduled_time']) ? $this->_data['scheduled_time'] : 'immediate';

        echo "SMS sent to $recipient: $message (Scheduled for: $scheduledTime)";
    }
}

class TwitterAdapter implements NotificationInterface
{
    protected $_data;
    public function setData($data)
    {
        $this->_data = $data;
    }
    public function sendNotification()
    {
        $twitterClient = new TwitterService();
        $twitterClient->setMessage($this->_data['message']);
        $twitterClient->sendTweet();
    }
}


class SmsAdapter implements NotificationInterface
{
    protected $_data;
    public function setData($data)
    {
        $this->_data = $data;
    }
    public function sendNotification()
    {
        $smsClient = new SmsService();
        $smsClient->setRecipient($this->_data['recipient']);
        $smsClient->setMessage($this->_data['message']);
        $smsClient->setScheduledTime($this->_data['scheduled_time']);
        $smsClient->sendText();
    }
}


interface INotificationManager
{
    public function sendNotification($type = '', $data);
}



class NotificationManager implements INotificationManager
{
    public function sendNotification($type = '', $data)
    {
        switch ($type) {
            case "twitter":
                $notification = new TwitterAdapter();
                break;
            case "sms":
                $notification = new SmsAdapter();
                break;
            default:
                echo "еrror";
                return false;
                break;
        }
        $notification->setData($data);
        $notification->sendNotification();
    }
}
$array = array(
    "message" => "This is tweet"
);

$a = new NotificationManager();
$a->sendNotification("twitter", $array); 
// Приклад використання для SMS з часом відправлення
$smsArray = [
    "recipient" => "1234567890",
    "message" => "This is an SMS message",
    "scheduled_time" => "2023-11-10 15:00:00"
];

$a->sendNotification("sms", $smsArray); 
?>