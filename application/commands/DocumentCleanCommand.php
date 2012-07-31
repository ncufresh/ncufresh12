<?php

class DocumentCleanCommand extends CConsoleCommand
{
    public function run($args)
    {
        $path = array_pop($args);
        if ( is_dir($path) && $directory = opendir($path) )
        {
            while ( ($filename = readdir($directory) ) !== false )
            {
                if ( $filename === '.' || $filename === '..' ) continue;
                if ( preg_match('/\.bak$/', $filename) ) continue;
                $file = $path . DIRECTORY_SEPARATOR . $filename;
                $this->cleanHTMLStyle($file);
            }
            closedir($directory);
        }
    }

    public function cleanHTMLStyle($filename)
    {
        $content = file_get_contents($filename);
        file_put_contents($filename . '.bak', $content);

        $content = preg_replace('/(<(?!img)\w+[^>]+)(style="[^"]+")([^>]*)(>)/u', '${1}${3}${4}', $content);
        $content = preg_replace('/\s>/u', '>', $content);
        $content = preg_replace('/:\s/u', ':', $content);
        $content = preg_replace('/;\s/u', ';', $content);
        $content = preg_replace('/\t/u', '', $content);
        $content = preg_replace('/\n$/u', '', $content);
        $content = preg_replace('/&nbsp;/u', '', $content);
        $content = preg_replace('/<p>[\r\n\t\s]+<\/p>/u', '', $content);
        $content = preg_replace('/<h3>(.+)<\/h3>/u', '<h6>${1}</h6>', $content);
        $content = preg_replace('/<h2>(.+)<\/h2>/u', '<h5>${1}</h5>', $content);
        $content = preg_replace('/<h1>(.+)<\/h1>/u', '<h4>${1}</h4>', $content);
        $content = preg_replace('/\/upload\/images\/images\//u', '<?php echo Yii::app()->request->baseUrl; ?>/statics/documents/', $content);

        file_put_contents($filename, $content);
        echo '[SUCCESS] ' . $filename;
    }
}