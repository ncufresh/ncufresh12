<?php

class ChatDequeueCommand extends CConsoleCommand
{
    public function run($args)
    {
        Chat::storeMessages();
    }
}