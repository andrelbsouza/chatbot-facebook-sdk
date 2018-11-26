<?php
namespace ChatBot\TemplatesMessage;

use ChatBot\Element\ElementInterface;
use ChatBot\Message\Message;

interface TemplateInterface extends Message
{
    public function add(ElementInterface $element);
}