@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../eher/phpunit/bin/phpdcd
php "%BIN_TARGET%" %*
