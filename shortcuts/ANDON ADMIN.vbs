set WshShell = WScript.CreateObject("WScript.Shell")
 strDesktop = WshShell.SpecialFolders("Desktop")
set oShellLink = WshShell.CreateShortcut(strDesktop & "\Shortcut Script.lnk")
 oShellLink.IconLocation = "notepad.exe, 0"
set oUrlLink = WshShell.CreateShortcut(strDesktop & "\ANDON ADMIN.lnk")
 oUrlLink.TargetPath = "\\172.25.112.171\Live System\Andon System\ANDON Admin System 0.0.1.exe"
 oUrlLink.Save
 WScript.Echo("Shortcut successfully created.")