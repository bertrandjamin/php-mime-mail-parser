<?php

namespace PhpMimeMailParser\Contracts;

use PhpMimeMailParser\Attachment;
use PhpMimeMailParser\Exception;

interface ParserInterface
{
    /**
     * Attachment filename argument option for ->saveAttachments().
     * @var string
     */
    public const ATTACHMENT_DUPLICATE_THROW  = 'DuplicateThrow';
    /**
     * @var string
     */
    public const ATTACHMENT_DUPLICATE_SUFFIX = 'DuplicateSuffix';
    /**
     * @var string
     */
    public const ATTACHMENT_RANDOM_FILENAME  = 'RandomFilename';

    /**
     * Attachment types to include for ->getAttachment()
     * @var int
     */
    public const GA_INCLUDE_INLINE = 1; // include inline and top-level attachments
    /**
     * @var int
     */
    public const GA_INCLUDE_NESTED = 2; // all non-inline attachments, including nested
    /**
     * @var int
     */
    public const GA_INCLUDE_ALL = 3;    // inline and nested attachments
    /**
     * @var int
     */
    public const GA_TOPLEVEL = 0;       // only non-inline top-level attachments


    /**
     * Set the file path we use to get the email text
     *
     * @param string $path File path to the MIME mail
     */
    public function setPath(string $path): ParserInterface;

    /**
     * Set the Stream resource we use to get the email text
     *
     * @param resource $stream
     * @throws Exception
     */
    public function setStream($stream): ParserInterface;

    /**
     * Set the email text
     *
     * @param string $data
     */
    public function setText(string $data): ParserInterface;

    /**
     * Retrieve a specific Email Header, without charset conversion.
     *
     * @param string $name Header name (case-insensitive)
     *
     * @return string
     * @throws Exception
     */
    public function getHeaderRaw(string $name): string;

    /**
     * Retrieve a specific Email Header
     *
     * @param string $name Header name (case-insensitive)
     *
     * @return string|array|bool
     */
    public function getHeader(string $name);

    /**
     * Retrieve all mail headers
     *
     * @return array
     * @throws Exception
     */
    public function getHeaders(): array;

    /**
     * Retrieve the raw mail headers as a string
     *
     * @throws Exception
     */
    public function getHeadersRaw(): array;

    /**
     * Return an array with the following keys display, address, is_group
     *
     * @param string $name Header name (case-insensitive)
     */
    public function getAddresses(string $name): array;

    /**
     * Retrieve the resource
     *
     * @return resource resource
     */
    public function getResource();

    /**
     * Retrieve the file pointer to email
     *
     * @return resource stream
     */
    public function getStream();

    /**
     * Retrieve the text of an email
     *
     * @return string|null data
     */
    public function getData(): ?string;

    /**
     * Add a middleware to the parser MiddlewareStack
     * Each middleware is invoked when:
     *   a MimePart is retrieved by mailparse_msg_get_part_data() during $this->parse()
     * The middleware will receive MimePart $part and the next MiddlewareStack $next
     *
     * Eg:
     *
     * $Parser->addMiddleware(function(MimePart $part, MiddlewareStack $next) {
     *      // do something with the $part
     *      return $next($part);
     * });
     *
     * @param callable $middleware Plain Function or Middleware Instance to execute
     * @return void
     */
    public function addMiddleware(callable $middleware): void;
}
