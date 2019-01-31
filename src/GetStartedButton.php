<?php
namespace ChatBot;


class GetStartedButton
{
    public function add(string $postback){
        return [
            'get_started' => [
                'payload' => $postback
            ]
        ];
    }

    public function remove(){
        return [
            'fields' => [
                'get_started'
            ]
        ];
    }
}