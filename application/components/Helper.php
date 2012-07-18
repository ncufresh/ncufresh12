<?php

class Helper extends CBehavior
{
    public function getClientIP()
    {
        $list = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        foreach ( $list as $key )
        {
            if ( array_key_exists($key, $_SERVER) === true )
            {
                foreach ( explode(',', $_SERVER[$key]) as $ip )
                {
                    $ip = trim($ip);
                    if (
                        filter_var(
                            $ip,
                            FILTER_VALIDATE_IP,
                            FILTER_FLAG_IPV4/* | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE*/
                        ) !== false
                    )
                    {
                        return $ip;
                    }
                }
            }
        }
        return null;
    }

    function ip2long($ip)
    {
        if ( $ip === null ) return 0;
        list($a, $b, $c, $d) = explode('.', $ip);
        return (($a * 256 + $b) * 256 + $c) * 256 + $d;
    }

    function long2ip($long)
    {
        if ( $long < 0 || $long > 4294967295 ) return false;
        $ip = array();
        for ( $power = 3; $power >= 0 ; --$power )
        {
            $ip[] = (integer)($long / pow(256, $power));
            $long -= (integer)($long / pow(256, $power)) * pow(256, $power);
        }
        return implode('.', $ip);
    }

    function uuid()
    {
        return md5(uniqid('NCUFRESH2012' . mt_rand() . TIMESTAMP, true));
    }
}