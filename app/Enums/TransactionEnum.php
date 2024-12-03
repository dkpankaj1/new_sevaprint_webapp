<?php

namespace App\Enums;

enum TransactionEnum: string
{
    // Transaction Status
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FAILED = 'failed';

    // Transaction Direction
    const DIRECTION_CREDIT = 'credit';
    const DIRECTION_DEBIT = 'debit';

    // Transaction Type
    const TYPE_WALLET = 'wallet';
    const TYPE_RAZORPAY = 'razorpay';
    const TYPE_PHONEPE = 'phonepe';
    const TYPE_NICEPE = 'nicepe';


}
