<?php

namespace Bnzo\Fintecture\Enums;

enum ScheduledExpirationPolicy: string
{
    case Immediate = 'immediate';
    case Expire = 'expire';
}
