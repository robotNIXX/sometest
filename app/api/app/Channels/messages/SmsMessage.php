<?php

namespace app\Channels\messages;

class SmsMessage
{
    protected string $user;
    protected string $password;
    protected string $to;
    protected string $from;
    protected array $lines;

    /**
     * SmsMessage constructor.
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        $this->lines = $lines;
    }

    public function line($line = ''): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function to($to): self
    {
        $this->to = $to;

        return $this;
    }

    public function from($from): self
    {
        $this->from = $from;

        return $this;
    }
}