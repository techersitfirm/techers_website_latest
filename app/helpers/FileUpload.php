<?php

namespace App\Helpers;

class FileUpload
{
    public static function teamPhoto(
        array $file
    ): string {

        $directory = PUBLIC_PATH . '/teams/';

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        $extension = strtolower(
            pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            )
        );

        $filename = 'team_'
            . random_int(100000, 999999)
            . '_'
            . hrtime(true)
            . '.'
            . $extension;

        $destination = $directory . $filename;

        if (!move_uploaded_file(
            $file['tmp_name'],
            $destination
        )) {
            throw new \RuntimeException(
                'Unable to upload profile photo.'
            );
        }

        return 'teams/' . $filename;
    }
}