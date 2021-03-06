<?php

namespace PhpMimeMailParser\Contracts;

use PhpMimeMailParser\MiddlewareStack;
use PhpMimeMailParser\MimePart;

/**
 * Process Mime parts by either:
 *  processing the part or calling the $next MiddlewareStack
 */
interface Middleware
{
    /**
     *  Process a mime part, optionally delegating parsing to the $next MiddlewareStack
     *
     * @param MimePart $part
     * @param MiddlewareStack $next
     *
     * @return MimePart
     */
    public function parse(MimePart $part, MiddlewareStack $next): MimePart;
}
