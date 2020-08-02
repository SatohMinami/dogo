<?php

namespace App\Services;

use App\Services\Api\KarteService;

class ImgService
{
    const DIRECTORY_BACKUP = "&zzzbackup";

    public static function generalFilename($patient = [], $no = 1, $cdate, $tmstamp, $kbn = '')
    {
        $pidnum = isset($patient['PTID']) ? $patient['PTID'] : '';
        $pkana = isset($patient['PTNAMEKANA']) ? $patient['PTNAMEKANA'] : '';
        $pname = isset($patient['PTNAME']) ? $patient['PTNAME'] : '';
        $psex = isset($patient['SEX']) ? $patient['SEX'] : '';
        $pbirth = isset($patient['BIRTHDATE']) ? date('Ymd', strtotime($patient['BIRTHDATE'])) : '';
        $drNo = '';
        $drName = '';
        $kaNo = '';
        $kaName = '';

        return "&pidnum={$pidnum}&pkana={$pkana}&pname={$pname}&psex={$psex}&pbirth={$pbirth}&cdate={$cdate}&tmstamp={$tmstamp}&drNo={$drNo}&drName={$drName}&kaNo={$kaNo}&kaName={$kaName}&kbn={$kbn}&no={$no}.jpg";
    }

    public static function getFilenameKV($params = [])
    {
        $pid = $params['pidnum'];
        $dir = get_directory(config('cfg.directory_kv') . $pid);
        $files = scandir($dir);
        foreach ($files as $img) {
            if (isImage($img)) {
                $images[] = $img;
            }
        }
        return $images;
    }


    public static function rmImage($path, $filename)
    {
        $filepath = $path.$filename;

        if (file_exists($filepath)) {
            unlink($filepath);
        }

        return true;
    }

    public static function rmImages($path, $listFilename = [], $pathBackup = '', $successFlag = true, $pId = '')
    {
        if ($successFlag === true) {
            if (!empty($listFilename)) {
                foreach ($listFilename as $filename) {
                    self::rmImage($path, $filename);
                }
            }

            self::removeBackup($path.$pathBackup);
        } else {
            self::restoreFileError($pId, $path, $pathBackup);
        }

        return true;
    }

    /**
     * @param $path
     * @param $directories
     * @return bool
     * @description : Thuc hien xoa list danh sach cac thu muc trong 1 thu muc cha
     */
    public static function rmDirectories($path, $directories) {

        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $fullPath  = $path . $directory;
                if (file_exists($fullPath)) {
                    self::rmDirectory($fullPath);
                }
            }
        }

        return true;
    }

    /**
     * @param $directory
     * @return bool
     * @description
     * Thuc hien xoa thu muc
     * Neu thu muc co cac file hinh anh thi thuc hien xoa tat ca cac file hinh anh khoi thu muc trc , sau do se thuc hien xoa thu muc
     */
    public static function rmDirectory($directory) {
        if (file_exists($directory)) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    self::rmImage($directory . DIRECTORY_SEPARATOR, $file);
                }
            }

            rmdir($directory);
        }

        return true;
    }

    public static function moveImages($kvPath, $evPath, $listFilename = [], $active = 'update', $pathBackup = '')
    {
        if (!empty($listFilename)) {
            foreach ($listFilename as $filename) {
                self::moveImage($kvPath, $evPath, $filename, $active);
            }
        }

        if(is_dir($kvPath."&zzzbackup/") && $pathBackup == 'zzzbackup') {
            self::removeBackup($kvPath."&zzzbackup/");
        }

        return true;
    }

    public static function moveImage($kvPath, $evPath, $filename, $active = 'update')
    {
        $time       = time();
        $tmstamp    = date('Ymd His', $time);
        $changeName = "&upd={$tmstamp}";
        $fileMr = $kvPath."&zzzbackup/".$filename;
        if($active == 'DELETE') {
            $changeName = "&del={$tmstamp}";
            $fileMr = $kvPath.$filename;
        }

        $fileEv = $evPath.$changeName.$filename;

        if (file_exists($fileMr)) {
            copy($fileMr, $fileEv);
        }

        return true;
    }

    public static function findFilenameKV($listFiles = [], $params = [])
    {
        if (!empty($listFiles)) {
            foreach ($listFiles as $file) {
                $filename = explode('.', $file)[0];
                parse_str($filename, $out);
                if (($out['pidnum'] == $params['pidnum']) && ($out['tmstamp'] == $params['tmstamp']) && ($out['kbn'] == $params['kbn']) && ($out['no'] == $params['no'])) {
                    return $file;
                }
            }
        }
        return null;
    }

    /**
     * |----------------------------------------------------------------------
     * | @functionName : upload image ....
     * |----------------------------------------------------------------------
     * | @param $fileUpload
     * | @param $filename
     * | @param $pathUpload
     * | @return bool
     * |----------------------------------------------------------------------
     */
    public static function uploadImage($fileUpload, $filename, $pathUpload)
    {
        try {
            $statusUpload = $fileUpload->move($pathUpload, $filename);
            return !empty($statusUpload) ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $filename
     * @return mixed
     * Lay thong tin filename
     * Bao gom
     * thong tin benh nhan, tmstamps no, kbn.
     */
    public static function infoFromFile($filename) {
        parse_str($filename, $output);

        return $output;
    }

    /**
     * @param $path
     * @param $filename
     * Thuc hien copies file : di chuyen toi thu muc backup
     */
    public static function backupImage($path, $file)
    {
        $pathBackup = $path . self::DIRECTORY_BACKUP . DIRECTORY_SEPARATOR;
        $source = $path . $file;
        $target = $pathBackup . $file;

        if(!file_exists($pathBackup)) {
            mkdir($pathBackup);
        } else {
            if (file_exists($source)) {
                if (!file_exists($target)) {
                    copy($source, $target);
                }
            }
        }

        return true;
    }

    /**
     * @param $path
     * @param $files
     * @return bool
     * Thuc hien di chuyen all file trong cung thu muc
     */
    public static function backupImages($path, $files) {
        if (!empty($files)) {
            foreach ($files as $file) {
                self::backupImage($path, $file);
            }
        }

        return true;
    }

    /**
     * @param $pId
     * @param array $mrArray
     * @param array $kvArray
     * @param bool $backupFlag
     * Neu backupFlag = true ===> thuc hien cong viec backup du lieu
     * Neu backupFlag = false ==> thuc hien cong viec xoa cac du lieu backup.
     * Tam thoi chua check phan tmp folder
     */
    public static function backupKarteImage($pId, $mrArray = [], $kvArray = [], $backupFlag = true) {
        $mrPath         = get_directory(config("cfg.directory") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
        $kvPath         = get_directory(config("cfg.directory_kv") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
        $cachePath      = get_directory(config("cfg.directory_cache") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);

//        $tmpPath        = get_directory(config("cfg.directory_tmp") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
//        $directoriesTmpPath = KarteService::listDirectoryCache($mrArray);

        if ($backupFlag === true) {
            // backup kv, cache,mr files and tmp directory
            ImgService::backupImages($kvPath, $kvArray);
            ImgService::backupImages($cachePath, $kvArray);

            ImgService::backupImages($mrPath, $mrArray);
//            ImgService::backupImages($tmpPath, $directoriesTmpPath);// backup thu muc
        }
    }

    public static function restoreFileError($pId, $mrArray = [], $kvArray = [], $backupFlag = true) {
        $mrPath         = get_directory(config("cfg.directory") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR . '&zzzbackup');
        $kvPath         = get_directory(config("cfg.directory_kv") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR. '&zzzbackup');
        $cachePath      = get_directory(config("cfg.directory_cache") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR. '&zzzbackup');

        if ($backupFlag === true) {
            // backup kv, cache,mr files and tmp directory
            if(is_dir($mrPath)) {
                $filenames = scandir($mrPath);
                if (!empty($filenames)) {
                    foreach ($filenames as $filename) {
                        if ($filename != '.' && $filename != '..') {
                            $pathOld = get_directory(config("cfg.directory") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
                            $source = $mrPath . DIRECTORY_SEPARATOR . $filename;
                            $target = $pathOld . $filename;
                            if (file_exists($source)) {
                                if (!file_exists($target)) {
                                    copy($source, $target);
                                }
                            }
                        }
                    }
                }
            }

            if(is_dir($kvPath)) {
                $filenames = scandir($kvPath);
                if (!empty($filenames)) {
                    foreach ($filenames as $filename) {
                        if ($filename != '.' && $filename != '..') {
                            $pathOld = get_directory(config("cfg.directory_kv") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
                            $source = $kvPath . DIRECTORY_SEPARATOR . $filename;
                            $target = $pathOld . $filename;
                            if (file_exists($source)) {
                                if (!file_exists($target)) {
                                    copy($source, $target);
                                }
                            }
                        }
                    }
                }
            }

            if(is_dir($cachePath)) {
                $filenames = scandir($cachePath);
                if (!empty($filenames)) {
                    foreach ($filenames as $filename) {
                        if ($filename != '.' && $filename != '..') {
                            $pathOld = get_directory(config("cfg.directory_cache") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR);
                            $source = $cachePath . DIRECTORY_SEPARATOR . $filename;
                            $target = $pathOld . $filename;
                            if (file_exists($source)) {
                                if (!file_exists($target)) {
                                    copy($source, $target);
                                }
                            }
                        }
                    }
                }
            }


            self::removeBackup(get_directory(config("cfg.directory") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR . '&zzzbackup/'));
            self::removeBackup(get_directory(config("cfg.directory_kv") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR . '&zzzbackup/'));
            self::removeBackup(get_directory(config("cfg.directory_cache") . DIRECTORY_SEPARATOR . $pId . DIRECTORY_SEPARATOR . '&zzzbackup/'));
        }
    }

    public static function removeBackup($pathBackup) {
        if(is_dir($pathBackup)) {
            $filenames = scandir($pathBackup);
            if (!empty($filenames)) {
                foreach ($filenames as $filename) {
                    if ($filename != '.' && $filename != '..') {
                        unlink($pathBackup.$filename);
                    }
                }
            }

            rmdir($pathBackup);
        }
    }
}
