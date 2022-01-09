<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Common\Validation;

use Laminas\Filter\FilterInterface;

use function is_string;
use function Shlinkio\Shlink\Common\parseOrderBy;

class OrderByFilter implements FilterInterface
{
    /**
     * @return array{string|null, string|null}
     */
    public function filter(mixed $value): array
    {
        return $value === null || ! is_string($value) ? [null, null] : parseOrderBy($value);
    }
}
