<?php

namespace App\Enums;

enum NudgeStatusEnum: string
{
  case Pending = 'pending';
  case Sent = 'sent';
  case Failed = 'failed';
}