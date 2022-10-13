<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class SmsNotificationLog extends Model
{
    public $table = 'sms_notification_logs';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'notificationable_id',
        'notificationable_type',
        'type',
        'content',
        'phone_number',
        'status',
        'status_code',
        'status_text',
        'sending_response',
        'sending_request',
        'webhook_response',
        'created_at',
        'updated_at',
    ];

    public const LOG_TYPE = [
        '1' => 'account_verification',
        '2' => 'signup_welcome_message',
    ];

    /**
     * Get the parent notificationable model (patient or specialist).
     */
    public function notificationable()
    {
        return $this->morphTo();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
