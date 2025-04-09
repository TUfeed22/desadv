<?php

namespace App\Dto;

use DateTimeImmutable;

final readonly class DesadvXmlDto
{
    public function __construct(
        public int               $number,
        public DateTimeImmutable $date,
        public int               $recipient,
        public int               $sender,
        public array             $body
    )
    {

    }
}