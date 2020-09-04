<?php
class NotificationStrategyFactory
{
    public function getStrategy(): NotificationStrategyInterface
    {
        switch ($strategy) {
            case 'sms':
                return new SmsNotificationStrategy;
            case 'email':
                return new EmailNotificationStrategy;
        }
    }
}
