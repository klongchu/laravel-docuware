<?php

namespace Klongchu\DocuWare\Tests\Feature;

use Klongchu\DocuWare\DocuWare;
use Klongchu\DocuWare\Support\Auth;

uses()->group('authorization');

it('authorization with & without cookie', function () {
    if (config('docuware.cookies')) {
        $this->assertArrayHasKey(Auth::COOKIE_NAME, Auth::cookies());

        (new DocuWare())->getFileCabinets();
    }

    if (! config('docuware.cookies')) {
        $this->assertNull(Auth::cookies());

        (new DocuWare())->getFileCabinets();

        $this->assertArrayHasKey(Auth::COOKIE_NAME, Auth::cookies());

        (new DocuWare())->logout();
        $this->assertNull(Auth::cookies());
    }
});
