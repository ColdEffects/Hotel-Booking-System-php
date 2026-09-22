@echo off
setlocal enabledelayedexpansion

REM ===== EDIT THIS PATH to your actual repo folder =====
set REPO_PATH=C:\path\to\your\repo

REM ===== How many hours you want the pushes spread across (e.g. 12 = 9am-9pm) =====
set SPREAD_HOURS=12

cd /d "%REPO_PATH%"

REM Pick a random number of runs between 7 and 14
set /a RUNS=7 + %RANDOM% %% 8
echo Will push %RUNS% times today.

REM Total spread in seconds
set /a SPREAD_SECONDS=%SPREAD_HOURS% * 3600
set /a AVG_GAP=%SPREAD_SECONDS% / %RUNS%

for /l %%i in (1,1,%RUNS%) do (
    echo Push %%i of %RUNS% at %time%
    echo %date% %time% >> daily-log.txt
    git add .
    git commit -m "Update %%i - %date% %time%"
    git push

    REM Random delay before next push: between 50%% and 150%% of the average gap
    set /a MIN_WAIT=%AVG_GAP% / 2
    set /a MAX_WAIT=%AVG_GAP% * 3 / 2
    set /a RANGE=!MAX_WAIT! - !MIN_WAIT!
    set /a WAIT=!MIN_WAIT! + !RANDOM! %% !RANGE!

    if %%i lss %RUNS% (
        echo Waiting !WAIT! seconds before next push...
        timeout /t !WAIT! /nobreak > nul
    )
)

echo Done for today.
