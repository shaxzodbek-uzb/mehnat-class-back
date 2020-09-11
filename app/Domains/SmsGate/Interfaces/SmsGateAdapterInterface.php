<?php
interface SmsGateAdapterInterface
{
    public function send(string $phone, string $message): json;
    public function status(string $message_id): json;
}