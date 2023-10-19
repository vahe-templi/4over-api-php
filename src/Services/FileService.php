<?php

namespace FourOver\Services;

use FourOver\Entities\File\FileCreatedResponse;

class FileService extends AbstractService
{
    /**
     * https://api-users.4over.com/?page_id=104
     *
     * @return FileCreatedResponse
     */
    public function createFile(string $url) : FileCreatedResponse
    {
        $postBodyData = [
            'path' => [$url]
        ];

        return $this->getResource('POST', '/files', ['body' => json_encode($postBodyData)], FileCreatedResponse::class);
    }
}