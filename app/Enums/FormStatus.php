<?php

namespace App\Enums;

enum FormStatus: string
{    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETE = 'complete';
    const STATUS_REFUND = 'refund';
    const STATUS_REJECT = 'reject';
}
