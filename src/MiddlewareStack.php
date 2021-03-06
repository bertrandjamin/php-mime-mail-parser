<?php

namespace PhpMimeMailParser;

use PhpMimeMailParser\Contracts\MiddleWare;

/**
 * A stack of middleware chained together by (MiddlewareStack $next)
 */
final class MiddlewareStack
{
    /**
     * Next MiddlewareStack in chain
     *
     * @var MiddlewareStack
     */
    protected $next;

    /**
     * Middleware in this MiddlewareStack
     *
     * @var Middleware
     */
    protected $middleware;

    /**
     * Construct the first middleware in this MiddlewareStack
     * The next middleware is chained through $MiddlewareStack->add($Middleware)
     *
     * @param Middleware $middleware
     */
    public function __construct(MiddleWare $middleware = null)
    {
        $this->middleware = $middleware;
    }

    /**
     * Creates a chained middleware in MiddlewareStack
     *
     * @param Middleware $middleware
     * @return MiddlewareStack Immutable MiddlewareStack
     */
    public function add(MiddleWare $middleware)
    {
        $stack = new static($middleware);
        $stack->next = $this;
        return $stack;
    }

    /**
     * Parses the MimePart by passing it through the Middleware
     * @param MimePart $part
     * @return \PhpMimeMailParser\MimePart|mixed
     */
    public function parse(MimePart $part)
    {
        if (!$this->middleware) {
            return $part;
        }
        return call_user_func([$this->middleware, 'parse'], $part, $this->next);
    }

    /**
     * Creates a MiddlewareStack based on an array of middleware
     *
     * @param Middleware[] $middlewares
     */
    public static function factory(array $middlewares = []): \PhpMimeMailParser\MiddlewareStack
    {
        $stack = new static;
        foreach ($middlewares as $middleware) {
            $stack = $stack->add($middleware);
        }
        return $stack;
    }

    /**
     * Allow calling MiddlewareStack instance directly to invoke parse()
     *
     * @param MimePart $part
     */
    public function __invoke(MimePart $part): \PhpMimeMailParser\MimePart
    {
        return $this->parse($part);
    }
}
