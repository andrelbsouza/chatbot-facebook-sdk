<?php
namespace ChatBot;

use PHPUnit\Framework\TestCase;

class GetStartedButtonTest extends TestCase
{

    public function testAddGetStartedButton(){
        $data = (new GetStartedButton())->add('iniciar');
        $callSendApi = new CallSendApi('SEU TOKEN AQUI');
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE);

        $this->assertTrue(is_string($result));
    }

    public  function  testRemoveGetStartedButton(){
        $data = (new GetStartedButton())->remove();
        $callSendApi = new CallSendApi('SEU TOKEN AQUI');
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE, 'DELETE');

    }

}