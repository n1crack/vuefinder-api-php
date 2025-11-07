<?php

namespace App\Http\Controllers\Handlers;

use Illuminate\Http\JsonResponse;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToDeleteDirectory;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToMoveFile;
use League\Flysystem\UnableToCopyFile;
use Ozdemir\VueFinder\Exceptions\PathNotFoundException;
use Throwable;

class VueFinderExceptionHandler
{
    private const READONLY_MESSAGE = 'readonly adapter';

    private const ERROR_MAP = [
        UnableToWriteFile::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Write operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to write file. The file may be write-protected or you may not have sufficient permissions.',
                'code' => 'write_protected',
                'status' => 403,
            ],
        ],
        UnableToDeleteFile::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Delete operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to delete file. The file may be protected or you may not have sufficient permissions.',
                'code' => 'delete_protected',
                'status' => 403,
            ],
        ],
        UnableToDeleteDirectory::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Delete operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to delete directory. The directory may be protected or you may not have sufficient permissions.',
                'code' => 'delete_protected',
                'status' => 403,
            ],
        ],
        UnableToCreateDirectory::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Create operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to create directory. You may not have sufficient permissions or the directory may already exist.',
                'code' => 'create_directory_failed',
                'status' => 403,
            ],
        ],
        UnableToMoveFile::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Move operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to move file. The destination location may be write-protected.',
                'code' => 'move_failed',
                'status' => 403,
            ],
        ],
        UnableToCopyFile::class => [
            'readonly' => [
                'message' => 'Storage adapter is read-only. Copy operations are not allowed.',
                'code' => 'readonly_storage',
                'status' => 403,
            ],
            'default' => [
                'message' => 'Unable to copy file. The destination location may be write-protected.',
                'code' => 'copy_failed',
                'status' => 403,
            ],
        ],
    ];

    public function handle(Throwable $exception): JsonResponse
    {
        $exceptionClass = get_class($exception);

        // Handle PathNotFoundException
        if ($exception instanceof PathNotFoundException) {
            return $this->errorResponse(
                $exception->getMessage() ?: 'The specified path does not exist.',
                404,
                'path_not_found'
            );
        }

        // Check if we have a specific handler for this exception
        if (isset(self::ERROR_MAP[$exceptionClass])) {
            $config = $this->getErrorConfig($exception, $exceptionClass);
            return $this->errorResponse($config['message'], $config['status'], $config['code']);
        }

        // Handle FilesystemException
        if ($exception instanceof FilesystemException) {
            return $this->errorResponse(
                'Filesystem error occurred.',
                500,
                'filesystem_error'
            );
        }

        // Handle any other exception
        return $this->errorResponse(
            'An unexpected error occurred.',
            500,
            'unknown_error'
        );
    }

    private function getErrorConfig(Throwable $exception, string $exceptionClass): array
    {
        $message = strtolower($exception->getMessage());
        $isReadonly = str_contains($message, self::READONLY_MESSAGE);

        $key = $isReadonly ? 'readonly' : 'default';
        return self::ERROR_MAP[$exceptionClass][$key];
    }

    private function errorResponse(string $message, int $statusCode, string $code): JsonResponse
    {
        return response()->json(compact('message', 'code'), $statusCode);
    }
}

