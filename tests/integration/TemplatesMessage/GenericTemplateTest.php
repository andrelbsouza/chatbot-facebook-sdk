<?php
namespace ChatBot\TemplatesMessage;

use ChatBot\Element\Button;
use ChatBot\Element\Product;
use PHPUnit\Framework\TestCase;

class GenericTemplateTest extends TestCase
{
    public function  testListaComTresProdutos(){
        $button = new Button('web_url', null, 'https://angular.io');
        $product = new Product('Curso de Angular','https://angular.io/assets/images/logos/angularjs/AngularJS-Shield.svg','Curso de Angular', $button);

        $button = new Button('web_url', null, 'https://php.net');
        $product2 = new Product('Curso de PHP','https://cdn.worldvectorlogo.com/logos/php-1.svg','Curso de PHP', $button);

        $button = new Button('web_url', null, 'https://vuejs.org');
        $product3 = new Product('Curso de Vuejs','https://cdn-images-1.medium.com/max/1200/1*OrjCKmou1jT4It5so5gvOA.jpeg','Curso de Vuejs', $button);

        $template = new GenericTemplate(1234);
        $template->add($product);
        $template->add($product2);
        $template->add($product3);

        $actual = $template->message('dasdas');

        $expected = [
            'recipient' => [
                'id' => 1234
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'buttons' => [
                            [
                                'title' => 'Curso de Angular',
                                'subtitle' => 'Curso de Angular',
                                'image_url' => 'https://angular.io/assets/images/logos/angularjs/AngularJS-Shield.svg',
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url' => 'https://angular.io',
                                ],
                            ],
                            [
                                'title' => 'Curso de PHP',
                                'subtitle' => 'Curso de PHP',
                                'image_url' => 'https://cdn.worldvectorlogo.com/logos/php-1.svg',
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url' => 'https://php.net',
                                ],
                            ],
                            [
                                'title' => 'Curso de Vuejs',
                                'subtitle' => 'Curso de Vuejs',
                                'image_url' => 'https://cdn-images-1.medium.com/max/1200/1*OrjCKmou1jT4It5so5gvOA.jpeg',
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url' => 'https://vuejs.org',
                                ],
                            ],
                        ]
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $actual);
    }
}