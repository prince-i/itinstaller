    set WshShell = WScript.CreateObject("WScript.Shell")
    strDesktop = WshShell.SpecialFolders("Desktop")
    set oShellLink = WshShell.CreateShortcut(strDesktop & "\Shortcut Script.lnk")
        '  oShellLink.TargetPath = WScript.ScriptFullName
        '  oShellLink.WindowStyle = 1
        '  oShellLink.Hotkey = "Ctrl+Alt+e"
         oShellLink.IconLocation = "notepad.exe, 0"
        '  oShellLink.Description = "Shortcut Script"
        '  oShellLink.WorkingDirectory = strDesktop
        '  oShellLink.Save
         set oUrlLink = WshShell.CreateShortcut(strDesktop & "\ANDON SYSTEM.lnk")
         oUrlLink.TargetPath = "\\172.25.112.171\Live System\Andon System\ANDON System 0.0.1.exe"
         oUrlLink.Save
