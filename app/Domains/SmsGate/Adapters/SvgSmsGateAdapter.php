<?php
use App\Domains\SmsGate\Services\BeelineSmsGate;

class SvgSmsAdapterGate implements SmsGateAdapterInterface
{
    protected $gate;

    public function __construct()
    {
        $this->gate = new BeelineSmsGate;
    }

    public function send(string $phone, string $message): json
    {
        return $this->gate->sendMessage([$phone], $message);
    }
    public function status(string $message_id): json
    {
        return $this->gate->getStatus($message_id);
    }
}