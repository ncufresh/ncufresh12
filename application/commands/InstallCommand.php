<?php

class InstallCommand extends CConsoleCommand
{
    public function run($args)
    {
        $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'databases';
        if ( is_dir($path) && $directory = opendir($path) )
        {
            while ( ($filename = readdir($directory) ) !== false )
            {
                if ( $filename === '.' || $filename === '..' ) continue;
                $file = $path . DIRECTORY_SEPARATOR . $filename;
                Yii::app()->db->createCommand(file_get_contents($file))->execute();
                echo '[EXECUTE]: ' . $filename . chr(10);
            }
            closedir($directory);
        }
    }
}