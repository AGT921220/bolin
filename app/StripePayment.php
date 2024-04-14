<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Mail;
class StripePayment extends Authenticatable
{
   protected $table = 'stripe_payment';
}
