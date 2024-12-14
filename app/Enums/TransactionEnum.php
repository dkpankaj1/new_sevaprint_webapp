<?php

namespace App\Enums;

enum TransactionEnum: string
{

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FAILED = 'failed';

    const DIRECTION_CREDIT = 'credit';
    const DIRECTION_DEBIT = 'debit';

    const METHOD_WALLET = 'wallet';

    const TYPE_INTERNAL = 'internal';
    const TYPE_EXTERNAL = 'external';

    const VENDOR_INTERNAL = 'internal';
    const VENDOR_RAZORPAY = 'razorpay';
    const VENDOR_PHONEPE = 'phonepe';
    const VENDOR_NICEPE = 'nicepe';


}
