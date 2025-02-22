<?php

declare(strict_types=1);

namespace Jose\Component\Signature;

use function array_key_exists;
use InvalidArgumentException;

class Signature
{
    private ?string $encodedProtectedHeader;

    private array $protectedHeader;

    public function __construct(
        private string $signature,
        array $protectedHeader,
        ?string $encodedProtectedHeader,
        private array $header
    ) {
        $this->protectedHeader = $encodedProtectedHeader === null ? [] : $protectedHeader;
        $this->encodedProtectedHeader = $encodedProtectedHeader;
    }

    /**
     * The protected header associated with the signature.
     */
    public function getProtectedHeader(): array
    {
        return $this->protectedHeader;
    }

    /**
     * The unprotected header associated with the signature.
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * The protected header associated with the signature.
     */
    public function getEncodedProtectedHeader(): ?string
    {
        return $this->encodedProtectedHeader;
    }

    /**
     * Returns the value of the protected header of the specified key.
     *
     * @param string $key The key
     *
     * @return mixed|null Header value
     */
    public function getProtectedHeaderParameter(string $key)
    {
        if ($this->hasProtectedHeaderParameter($key)) {
            return $this->getProtectedHeader()[$key];
        }

        throw new InvalidArgumentException(sprintf('The protected header "%s" does not exist', $key));
    }

    /**
     * Returns true if the protected header has the given parameter.
     *
     * @param string $key The key
     */
    public function hasProtectedHeaderParameter(string $key): bool
    {
        return array_key_exists($key, $this->getProtectedHeader());
    }

    /**
     * Returns the value of the unprotected header of the specified key.
     *
     * @param string $key The key
     *
     * @return mixed|null Header value
     */
    public function getHeaderParameter(string $key)
    {
        if ($this->hasHeaderParameter($key)) {
            return $this->header[$key];
        }

        throw new InvalidArgumentException(sprintf('The header "%s" does not exist', $key));
    }

    /**
     * Returns true if the unprotected header has the given parameter.
     *
     * @param string $key The key
     */
    public function hasHeaderParameter(string $key): bool
    {
        return array_key_exists($key, $this->header);
    }

    /**
     * Returns the value of the signature.
     */
    public function getSignature(): string
    {
        return $this->signature;
    }
}
