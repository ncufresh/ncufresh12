@ECHO OFF

@SETLOCAL

SET YII_PATH=%~dp0

IF "%PHP_COMMAND%" == "" SET PHP_COMMAND=php.exe

"%PHP_COMMAND%" "%YII_PATH%yiic" %*

@ENDLOCAL