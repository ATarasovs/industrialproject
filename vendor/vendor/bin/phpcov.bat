@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../eher/phpunit/bin/phpcov
php "%BIN_TARGET%" %*
