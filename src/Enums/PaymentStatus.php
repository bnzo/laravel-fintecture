<?php

namespace Bnzo\Fintecture\Enums;

enum PaymentStatus: string
{
    case PaymentCreated = 'payment_created';
    case PaymentPending = 'payment_pending';
    case PaymentCancelled = 'payment_cancelled';
    case PaymentUnsuccessful = 'payment_unsuccessful';
    case PaymentError = 'payment_error';
    case ScaRequired = 'sca_required';
    case ProviderRequired = 'provider_required';
    case PaymentWaiting = 'payment_waiting';
    case OrderCreated = 'order_created';
}
