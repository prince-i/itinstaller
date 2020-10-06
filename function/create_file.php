<?php
    if(isset($_POST["btn_create"])){
       
        // $system_shortcut_lnk = "\\".$system_name; //shortcut name
        // $dir = $_GET['directory']; //directory of file
        $system_name = $_POST['sys_name']; //file name
        $system_shortcut_lnk = "\\".$system_name;
        $dir = $_POST['dir_name'].".exe";
        $myfile = fopen("../shortcuts/".$system_name.".vbs",'w') or die("failed");
        $code_line1 = 'set WshShell = WScript.CreateObject("WScript.Shell")'."\n";
        $code_line2 = ' strDesktop = WshShell.SpecialFolders("Desktop")'."\n";
        $code_line3 = 'set oShellLink = WshShell.CreateShortcut(strDesktop & "\Shortcut Script.lnk")'."\n";
        $code_line4 = ' oShellLink.IconLocation = "notepad.exe, 0"'."\n";
        $code_line5 = 'set oUrlLink = WshShell.CreateShortcut(strDesktop & "'.$system_shortcut_lnk.'.lnk")'."\n";
        $code_line6 = ' oUrlLink.TargetPath = "'.$dir.'"'."\n";
        $code_line7 = ' oUrlLink.Save'."\n";
        $code_line8 = ' WScript.Echo("Shortcut successfully created.")';
        fwrite($myfile,$code_line1);      
        fwrite($myfile,$code_line2);  
        fwrite($myfile,$code_line3);  
        fwrite($myfile,$code_line4);  
        fwrite($myfile,$code_line5);  
        fwrite($myfile,$code_line6);  
        fwrite($myfile,$code_line7); 
        fwrite($myfile,$code_line8);
        if(fclose($myfile)){
            echo "<script>alert('Successfully created a shortcut, ready for download.')</script>";
            echo "<script>window.location.replace('../admin/dashboard.php')</script>";
    }
}
?>