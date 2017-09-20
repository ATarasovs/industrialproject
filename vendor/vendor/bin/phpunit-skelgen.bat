@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../eher/phpunit/bin/phpunit-skelgen
php "%BIN_TARGET%" %*
