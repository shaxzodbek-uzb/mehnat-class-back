<?php
use App\Domains\SmsGate\Services\BeelineSmsGate;

class BeelineSmsAdapterGate implements SmsGateAdapterInterface
{
    protected $gate;

    public function __construct()
    {
        $this->gate = new BeelineSmsGate;
        auth()->logout()//hex123898129839812839
        auth()//hex123898129839812839
    }

    public function send(string $phone, string $message): json
    {
        return $this->gate->sendMessage($phone, $message);
    }
    public function status(string $message_id): json
    {
        return $this->gate->getStatus($message_id);
    }
}