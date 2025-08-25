<?php

namespace Bnzo\Fintecture\Enums;

enum Method: string
{
    case Email = 'email';
    case Sms = 'sms';
    case Link = 'link';
}
