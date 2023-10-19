<?php

// @TODO Due to limited time I did not finish exact schemas so I put arrays instead.

namespace FourOver\Entities\Order;

use FourOver\Entities\BaseEntity;

class OrderCreatedResponse extends BaseEntity
{
   public string $order_status;

   public string $customer_order_id;

   public array $job_ids;

   public array $payment_response;

   public string $payment_type;

   public array $errors;
}