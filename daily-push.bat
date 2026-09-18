@echo off
REM ===== EDIT THIS PATH to your actual repo folder =====
cd /d "C:\path\to\your\repo"

REM Optional: make a small change so there's something to commit.
REM Remove or replace this line if you already have real changes to push.
echo %date% %time% >> daily-log.txt

git add .
git commit -m "Daily update"
git push

REM Keep the window open if you're testing manually (remove for silent scheduled runs)
REM pause
