<?php
namespace Tests\PhpMimeMailParser\Stubs;

use \PhpMimeMailParser\Contracts\AttachmentInterface;
use \PhpMimeMailParser\Contracts\ParserInterface;
use \PhpMimeMailParser\MimePart;

class AnotherAttachment implements AttachmentInterface
{
    public function getFilename(): string
    {
    }

    public function getContentType(): string
    {
    }

    public function getContentDisposition(): string
    {
    }

    public function getContentID(): string
    {
    }

    public function getHeaders(): array
    {
    }

    public function getStream(): void
    {
    }

    public function getContent(): string
    {
    }

    public function getMimePartStr(): string
    {
    }

    public function save(
        $attachDir,
        $filenameStrategy = ParserInterface::ATTACHMENT_DUPLICATE_SUFFIX
    ): string {
    }

    public static function create(
        MimePart $part
    ): \Tests\PhpMimeMailParser\Stubs\AnotherAttachment {
        return new self();
    }
}
