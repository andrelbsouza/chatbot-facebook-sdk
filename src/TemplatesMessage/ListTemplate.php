<?php
namespace ChatBot\TemplatesMessage;

use ChatBot\Element\ElementInterface;

class ListTemplate implements TemplateInterface
{
    protected $products = [];
    protected $recipientId;

    /**
     * ButtonsTemplate constructor.
     * @param $recepientId
     */
    public function __construct(string $recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function add(ElementInterface $element){
        $this->products[] = $element->get();
    }

    public function message(string $messageText): array
    {
       return [
           'recipient' => [
                'id' => $this->recipientId
           ],
           'message' => [
               'attachment' => [
                   'type' => 'template',
                   'payload' => [
                       'template_type' => 'list',
                       'buttons' => $this->products
                   ],
               ],
           ],
       ];
    }
}