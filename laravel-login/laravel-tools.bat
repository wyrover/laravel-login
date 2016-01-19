::-------------------------------------------------------------------------
:: laravel-tools.bat
:: author: wyrover
:: date:    2015-10-25
:: version: 0.1
:: description:
::      把此批处理放在 laravel 项目目录，执行后选择菜单执行相关命令，在编辑器修改后
::      在 console 窗口按 ~ + Enter 重新选择命令执行


@echo off
if [%1] == [] goto runbat_args
if [%1] == [menu] goto menu
:runbat
@color 0A
@mode con cols=120 rows=30 >nul
@mode con cp select=936  >nul
doskey ~=%~dp0\%0 menu



:menu

CALL "C:\nginxstack\scripts\setenv.bat"


echo   ______________________________________________________________________
echo  ^|  1.路由列表                       2.创建控制器                      ^|
echo  ^|  3.创建模型带数据迁移             4.创建模型                        ^|
echo  ^|  5.创建数据迁移                   6.运行数据迁移                    ^|
echo  ^|  7.运行种子数据                   8.运行laravel                     ^|
echo  ^|  9.创建一个空函数的控制器         10.                               ^|
echo  ^|_____________________________________________________________________^|
echo.

echo.
echo.

set /p ID="Select action, press 0.99 key: "%
if %ID%#==1# goto cmd1
if %ID%#==2# goto cmd2
if %ID%#==3# goto cmd3
if %ID%#==4# goto cmd4
if %ID%#==5# goto cmd5
if %ID%#==6# goto cmd6
if %ID%#==7# goto cmd7
if %ID%#==8# goto cmd8
if %ID%#==9# goto cmd9
if %ID%#==10# goto cmd10
if %ID%#==11# goto cmd11
if %ID%#==12# goto cmd12
if %ID%#==13# goto cmd13
if %ID%#==14# goto cmd14
if %ID%#==15# goto cmd15
if %ID%#==16# goto cmd16
if %ID%#==17# goto cmd17
if %ID%#==18# goto cmd18
if %ID%#==19# goto cmd19
if %ID%#==20# goto cmd20
if %ID%#=="" goto menu
if %ID%#==34# goto menu

goto exit





::-------------------------------------------------------------------------
:: 路由列表
:cmd1
php artisan route:list
goto exit

::-------------------------------------------------------------------------
:: 创建控制器
:cmd2
::php artisan make:controller xxxxxController
php artisan make:controller xxxxxController
goto exit

::-------------------------------------------------------------------------
:: 创建模型带结构
:cmd3
::php artisan make:model --migration xxxxx
php artisan make:model --migration Post
goto exit

::-------------------------------------------------------------------------
:: 创建模型
:cmd4
php artisan make:model xxxxx
goto exit

::-------------------------------------------------------------------------
:: 创建数据迁移
:cmd5
php artisan make:migration create_xxxxx_table --create=xxxxx
goto exit

::-------------------------------------------------------------------------
:: 运行数据迁移
:cmd6
php artisan migrate
goto exit


::-------------------------------------------------------------------------
:: 运行种子数据
:cmd7
php artisan db:seed
goto exit

::-------------------------------------------------------------------------
:: 运行laravel
:cmd8
start "" "cmd /k php artisan serve --port=9091"
start "" "http://localhost:9091"
goto exit

::-------------------------------------------------------------------------
:: 创建一个空函数的控制器
:cmd9
::php artisan make:controller XxxxxController --plain
goto exit


::-------------------------------------------------------------------------
::
:cmd10
goto exit

::-------------------------------------------------------------------------
::
:cmd11
call tc.bat "C:\Users\ROVER\AppData\Roaming\npm"
goto exit


::-------------------------------------------------------------------------
::
:cmd12

goto exit

::-------------------------------------------------------------------------
::
:cmd13


goto exit

::-------------------------------------------------------------------------
::
:cmd14

goto exit

::-------------------------------------------------------------------------
::
:cmd15

goto exit


::-------------------------------------------------------------------------
::
:cmd16

goto exit


:runbat_args
start laravel-tools.bat 111

:exit
echo.