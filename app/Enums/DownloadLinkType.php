<?php

namespace App\Enums;

enum DownloadLinkType: string
{

    const directLink = 'Direct Link';
    const googleDriveId = 'Google Drive ID';
    const localPath = 'Local Path';

    public static function toArray()
    {
        return [
            self::directLink,
            self::googleDriveId,
            self::localPath,
        ];
    }
}