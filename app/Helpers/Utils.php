<?php
namespace App\Helpers;
use App\Models\BimbinganModel;
use App\Models\DriveModel;
use App\Libraries\DriveApi;

class Utils {
    public static function generateCode($code,$count)
    {
        switch ($count) {
            case $count<10:
                return $code.'00'.($count + 1);
                break;

            case $count>=10 && $count <100:
                return $code.'0'.($count + 1);
                break;
            case $count>=100:
                return $code.'0'.($count + 1);
                break;
            
            default:
                return 'error';
                break;
        }
    }

    public static function getUser($npm)
    {
        $model = new BimbinganModel();
        return $model->getField($npm)->getRow();
    }

    public static function exist_folder($username, $name, $jenis, $search)
    {
        $model = new DriveModel();
        $parentFolder = $model->getParentFolder2($search, $jenis);
        $check = $model->getWhere2($username, $jenis,$search);
        $driveId = '';
        if ($check == null) {
            $title = $username . ' - ' . $name;
            $driveId = DriveApi::createFolder($title, $parentFolder->drive_id);
            // dd($driveId);
            $data = [
                'username' => $username,
                'jenis' => $jenis,
                'drive_id' => $driveId,
                'keterangan'=>$search
            ];
            $model->insertData($data);
        } else {
            $driveId = $check->drive_id;
        }

        return $driveId;
    }
}