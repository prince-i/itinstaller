
<?php
    include 'config.php';
    $process = $_GET['process'];
    //load files
    if($process == 'load_shortcuts'){
        $dir = "../shortcuts";   //directory
        $files = preg_grep('/^([^.])/', scandir($dir));
        foreach($files as $f){

    echo '
    <tr>
        <td><i class="material-icons">list</i></td>
        <td>'.basename($f).'</td>
        <td><a class="btn green" href="function/download.php?file='.urlencode($f).'"><i class="material-icons">cloud_download</i></a></td>
    </tr>
            ';

        }
    }elseif($process == 'admin_load_view'){
        $dir = "../shortcuts";
        $files = preg_grep('/^([^.])/', scandir($dir));
        foreach($files as $f){
            echo '
                <tr>
                    
                    <td>'.basename($f).'</td>
                    <td>
                        <button class="btn red modal-trigger" onclick="get_file(&quot;'.basename($f).'&quot;)" data-target="modal_delete" title="Delete file"><i class="material-icons">delete</i></button>
                      
                        <a class="btn" title="Download this file" href="../function/download.php?file='.urlencode($f).'"><i class="material-icons">cloud_download</i></a>
                    </td>
                    
                </tr>  
                ';
    }
 }
// delete file
elseif($process == 'delete_file'){
    $file = $_GET['file'];
    if(unlink("../shortcuts/".$file)){
        echo "remove";
    }
    
}elseif($process == 'admin_del_user'){
    $id = $_GET['id'];
    $sql = "DELETE FROM user where id = '$id'";
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        echo "success";
    }
}
?>