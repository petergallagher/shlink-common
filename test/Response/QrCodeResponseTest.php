<?php

declare(strict_types=1);

namespace ShlinkioTest\Shlink\Common\Response;

use Endroid\QrCode\Builder\Builder;
use PHPUnit\Framework\TestCase;
use Shlinkio\Shlink\Common\Response\QrCodeResponse;

class QrCodeResponseTest extends TestCase
{
    /** @test */
    public function providedQrCodeIsSetAsBody(): void
    {
        $qrCode = Builder::create()->data('Hello')->build();
        $resp = new QrCodeResponse($qrCode);

        self::assertEquals($qrCode->getMimeType(), $resp->getHeaderLine('Content-Type'));
        self::assertEquals($qrCode->getString(), (string) $resp->getBody());
    }
}
