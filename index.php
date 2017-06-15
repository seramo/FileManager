<html dir="ltr" lang="en-US">
    <head>
        <title>fileManger</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/css/reset.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <?php
        if (isset($_GET['dir'])) {
            $dir = $_GET['dir'];
        } else {
            $dir = "myComputer";
        }
        ?>
        <script>
            function makeDir() {
                var dirName = prompt("please enter your folder name:");
                if (dirName === '') {
                    dirName = 'newFolder';
                }
                window.location = "mkdir.php?dir=<?php echo $dir; ?>&dirName=" + dirName;
            }
            function copyfile(filename) {
                var copypath = prompt("please enter your path to copy:");
                if (copypath === '') {
                    copypath = '<?php echo $dir; ?>';
                }
                window.location = "copyfile.php?dir=<?php echo $dir; ?>&fileName=" + filename + "&path=" + copypath;
            }
            function renamefile(filename) {
                var newName = prompt("please enter new name:");
                if (newName === '') {
                    alert('please fill new file name');
                } else {
                    window.location = "rename.php?dir=<?php echo $dir; ?>&fileName=" + filename + "&newName=" + newName;
                }
            }
            function deletefile(filename) {
                if (window.confirm("Do you want to delete fle")) {
                    window.location = "deletefile.php?dir=<?php echo $dir; ?>&fileName=" + filename;
                }
            }
        </script>
    </head>
    <body>
        <a href="?dir=<?php echo dirname($dir); ?>" title="backWard">
            <div class="file fa fa-arrow-circle-up"></div>
        </a>
        <a href="" title="">
            <div class="file fa fa-arrow-circle-left"></div>
        </a>
        <a href="" title="">
            <div class="file fa fa-arrow-circle-right"></div>
        </a>
        <a href="#" title="make directory" onclick="makeDir()" >
            <div class="file fa fa-plus-circle"></div>
        </a>
        <?php
        $filelist = glob($dir . '/*');
        foreach ($filelist as $file) {
            $filetype = filetype($file);
            if ($filetype == 'file') {
                ?>
                <div class="container-file">
                    <a href="#" title="" >
                        <div class="file fa fa-file-code-o"></div>
                        <span class="fname"><?php echo basename($file); ?></span>
                    </a>
                    <a href="#" class="file-action cfile" title="copy file" onclick="copyfile('<?php echo basename($file); ?>')"><i class="fa fa-copy"></i></a>
                    <a href="#" class="file-action rfile" title="rename file" onclick="renamefile('<?php echo basename($file); ?>')"><i class="fa fa-pencil-square"></i></a>
                    <a href="#" class="file-action dfile" title="delete file" onclick="deletefile('<?php echo basename($file); ?>')"><i class="fa fa-trash"></i></a>
                </div><!--.container-file-->
                <?php
            } elseif ($filetype == 'dir') {
                ?>
                <div class="container-file">
                    <a href="?dir=<?php echo $file ?>" title="" >
                        <div class="file fa fa-folder-o"></div>
                        <span><?php echo basename($file); ?></span>
                    </a>
                </div><!--.container-file-->
                <?php
            }
        }
        ?>

    </body>
</html>