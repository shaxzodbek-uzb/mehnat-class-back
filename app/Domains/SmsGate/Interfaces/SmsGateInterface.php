<?php
namespace App\Domains\SmsGate\Interfaces;

interface SmsGateInterface
{
    public function send(string $phone, string $message): json;
    public function getStatus(string $message_id): json;
}
