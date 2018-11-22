<?php
namespace ChatBot\Message;

class Text
{
    private $recipientId;
    /**
     * Text constructor.
     */
    public function __construct(string $recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function message(string $messageText) :array {
        return [
            'recipient' => [
                'id' => $this->recipientId
            ],
            'message' => [
                'text' => $messageText,
                'metadata' => 'DEVELOPER_DEFINED_METADA'
            ]
        ];
    }
}