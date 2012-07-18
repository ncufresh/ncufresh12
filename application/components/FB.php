<?php

class FB
{
    public static $facebook;

    public static function getFacebook()
    {
        if ( ! self::$facebook )
        {
            self::$facebook = new Facebook(array(
                'appId'         => '299021976861868',
                'secret'        => 'da3b004c79c3122de3a702a90a8a6dbf',
                'fileUpload'    => false
            ));
        }
        return self::$facebook;
    }
}