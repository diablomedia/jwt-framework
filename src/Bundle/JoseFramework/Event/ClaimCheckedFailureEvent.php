<?php

declare(strict_types=1);

namespace Jose\Bundle\JoseFramework\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Throwable;

final class ClaimCheckedFailureEvent extends Event
{
    public function __construct(
        private array $claims,
        private array $mandatoryClaims,
        private Throwable $throwable
    ) {
    }

    public function getClaims(): array
    {
        return $this->claims;
    }

    public function getMandatoryClaims(): array
    {
        return $this->mandatoryClaims;
    }

    public function getThrowable(): Throwable
    {
        return $this->throwable;
    }
}
