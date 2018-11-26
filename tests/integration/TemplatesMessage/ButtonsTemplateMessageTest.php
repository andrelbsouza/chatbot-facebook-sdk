<?php
namespace  ChatBot\TemplatesMessage;
use PHPUnit\Framework\TestCase;
use ChatBot\Element\Button;

class ButtonsTemplateMessageTest extends TestCase
{
    public  function testRetornoComBotaoTipoPostback(){
        $buttonsTemplate = new ButtonsTemplate(123);
        $buttonsTemplate->add( new Button('postback', 'Que tal uma resposta do Bot?', 'resposta'));
        $actual = $buttonsTemplate->message('Olha um exemplo de template com botões');

        $expected = [
            'recipient' => [
                'id' => 123
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'button',
                        'text' => 'Olha um exemplo de template com botões',
                        'buttons' => [
                            [
                                'type' => 'postback',
                                'title' => 'Que tal uma resposta do Bot?',
                                'payload' => 'resposta',
                            ],
                        ],
                    ],
                ],
            ],
        ];

         $this->assertEquals($expected, $actual);
    }
}