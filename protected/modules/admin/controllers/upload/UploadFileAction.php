<?php
    class UploadFileAction extends CAction {
        public function run() {
            if(isset($_POST['PHPSESSID']))
            {
                Yii::app()->session->close();
                Yii::app()->session->sessionID = $_POST['PHPSESSID'];
                Yii::app()->session->open();
            }
            if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');
            
            if (!empty($_FILES)) {

                $name = $_POST['name'];

                //isset($_POST['filename'])&&strlen(trim($_POST['filename']))>4?trim($_POST['filename']):$_FILES[$name]['name'];
                $filename = $_FILES[$name]['name'];
            	$tempFile = $_FILES[$name]['tmp_name'];
            	$targetPath = $_REQUEST['rootpath'].'/';
                $image = new ResizeImage();
                $image->load($tempFile);
                $image->save($targetPath.$filename, IMAGETYPE_PNG);
                $image->calculateScale(100);
                $image->save($targetPath.'thumb/'.$filename,IMAGETYPE_PNG);
                
                switch ($_FILES[$name]['error'])
                {     
                    case 0:
                     $msg = ""; // comment this out if you don't want a message to appear on success.
                     break;
                    case 1:
                      $msg = "The file is bigger than this PHP installation allows";
                      break;
                    case 2:
                      $msg = "The file is bigger than this form allows";
                      break;
                    case 3:
                      $msg = "Only part of the file was uploaded";
                      break;
                    case 4:
                     $msg = "No file was uploaded";
                      break;
                    case 6:
                     $msg = "Missing a temporary folder";
                      break;
                    case 7:
                     $msg = "Failed to write file to disk";
                     break;
                    case 8:
                     $msg = "File upload stopped by extension";
                     break;
                    default:
                    $msg = "unknown error ".$_FILES['userfile']['error'];
                    break;
                }

                if ($msg){ 
                    echo "Error: ".$_FILES['userfile']['error']." Error Info: ".$msg; 
                } else { 
                    echo "1";
                }
            }
            Yii::app()->end();
        }
    }