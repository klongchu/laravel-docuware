<?php

namespace Klongchu\DocuWare\Enums;

enum ConnectionEnum: string
{
    case WITHOUT_COOKIE = 'WITHOUT_COOKIE';
    case STATIC_COOKIE = 'STATIC_COOKIE';
    case DYNAMIC_COOKIE = 'DYNAMIC_COOKIE';
}
