<?php

namespace websightnl\yii2sms;

use yii\base\Component;

/**
 * Class Twilio
 * @package darkunz\yii2sms
 */
class Twilio extends Component implements GatewayInterface
{

    /**
     *
     */
    public $sid;
    
    /**
     *
     */
    public $token;
    
    /**
     *
     */
    public $number;

    /**
     * @var Twilio\Rest\Client
     */
    protected $client;
    
    public function init() {
        parent::init();
        $this->client = new \Twilio\Rest\Client($this->sid, $this->token);
    }
    
    /**
     * @param string|RecipientInterface $recipient either mobile number or object implementing RecipientInterface
     * @param string $message
     * @param array $options
     */
    public function send($recipient, $message, $options = []) {

        if ($recipient instanceof RecipientInterface) {
            $recipient = $recipient->getMobileNumber();
        }

        return $this->client->account->messages->create($this->number, $recipient, array(
            'Body' => $message
        ));
    }
    
} 
