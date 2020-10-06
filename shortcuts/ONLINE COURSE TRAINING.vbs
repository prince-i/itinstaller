set WshShell = WScript.CreateObject("WScript.Shell")
 strDesktop = WshShell.SpecialFolders("Desktop")
set oShellLink = WshShell.CreateShortcut(strDesktop & "\Shortcut Script.lnk")
 oShellLink.IconLocation = "notepad.exe, 0"
set oUrlLink = WshShell.CreateShortcut(strDesktop & "\ONLINE COURSE TRAINING.lnk")
 oUrlLink.TargetPath = "\\172.25.112.171\Live System\Online Course Training\Online Course Training.exe"
 oUrlLink.Save
 WScript.Echo("Shortcut successfully created.")