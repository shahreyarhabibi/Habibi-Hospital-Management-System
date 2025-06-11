@echo off
setlocal enabledelayedexpansion
set n=61

for %%f in (*.jpg) do (
  ren "%%f" "!n!.jpg"
  set /a n+=1
)
