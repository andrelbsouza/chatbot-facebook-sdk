<?php
namespace ChatBot;

use PHPUnit\Framework\TestCase;

class MenuManagerTest extends TestCase
{
    public function testMakeMenu(){
        $menu = new MenuManager('default');
        $call_to_actions = [
            [
                'id' => 1,
                'type' => 'nested',
                'title' => 'O que eu posso fazer?',
                'parent_id' => 0,
                'value' => null,
            ],
            [
                'id' => 2,
                'type' => 'web_url',
                'title' => 'Visite nosso site',
                'parent_id' => 0,
                'value' => 'https://sites.code.education/home-code/',
            ],
            [
                'id' => 3,
                'type' => 'web_url',
                'title' => 'Quer aprender Laravel e Vue?',
                'parent_id' => 1,
                'value' => 'http://sites.code.education/laravel-com-vuejs/',
            ],
            [
                'id' => 4,
                'type' => 'postback',
                'title' => 'Ver opções iniciais',
                'parent_id' => 1,
                'value' => 'iniciar',
            ],
        ];
        foreach ($call_to_actions as $action) {
            $menu->callToAction($action['id'], $action['type'], $action['title'], $action['parent_id'], $action['value']);
        }
        $callSendApi = new CallSendApi('EAAISyfaeoZAgBAPyZAH4ALrPGKu9UVQd21Jmd7qE4mYUWF970vvwf5hRETXR4R122wRiqrM5j0H86YjvopvRgTUt1R8bU6WyzlGMslKkVZCq4I1bG9wtOyxRRoJbZB52AfZBzEamMrwlfREio3Wwqsc6wyZCANeE3XRLu1fbXCFwZDZD');
        $result = $callSendApi->make($menu->toArray(), CallSendApi::URL_PROFILE);
        $this->assertTrue(is_string($result));
    }
}