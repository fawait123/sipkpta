<?php

namespace App\Helpers;

include '../../../app/vendor/autoload.php';

use Google\Exception;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Exception as ServiceException;
use Google_Client;


class DriveApi
{

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=./sipkpta-363910-e8e0ae7475dc.json');
    }


    public static function upload($file_name, $file_path, $mimeType, $parent)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=sipkpta-363910-e8e0ae7475dc.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes('https://www.googleapis.com/auth/drive.file');

        try {
            $service = new Drive($client);
            $file     = new DriveFile();
            $file->setName($file_name);
            $file->setParents(array($parent));
            $file->setDescription('upload file php');
            $file->setMimeType($mimeType);


            $result = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($file_path),
                    'mimeType' => $mimeType,
                    'uploadType' => 'media'
                ),
            );

            return $result->id;
        } catch (Exception $e) {
            $err = json_decode($e->getMessage());
            return $err;
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }

    public static function createFolder($folderName, $parent)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=sipkpta-363910-e8e0ae7475dc.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes('https://www.googleapis.com/auth/drive.file');
        try {
            $service = new Drive($client);
            $file     = new DriveFile();
            $file_path = $folderName;
            $file->setName($file_path);
            $file->setParents(array($parent));
            $file->setMimeType('application/vnd.google-apps.folder');


            $folder = $service->files->create(
                $file
            );

            return $folder->id;;
        } catch (ServiceException $e) {
            $err = json_decode($e->getMessage());
            return $err;
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }

    public static function getFile($fileId)
    {
        return 'https://drive.google.com/open?id=' . $fileId;
    }
}
