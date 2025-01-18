<?php

namespace App\Enums;

enum MobileRechargeEnums: string
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FAILED = 'failed';

}
