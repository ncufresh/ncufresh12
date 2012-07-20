<?php

class ChatDequeueCommand extends CConsoleCommand
{
    public function run($args)
    {
        $messages = Chat::model()->findAll();
        var_dump($messages);
    }
}