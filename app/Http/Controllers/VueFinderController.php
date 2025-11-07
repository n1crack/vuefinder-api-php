<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Ozdemir\VueFinder\Actions\VueFinderActionFactory;
use App\Http\Controllers\Handlers\VueFinderExceptionHandler;
use Throwable;

class VueFinderController extends Controller
{
    public function __construct(
        private VueFinderActionFactory $actionFactory,
        private VueFinderExceptionHandler $exceptionHandler
    ) {}

    private function executeAction(Request $request, string $actionName): JsonResponse|Response|SymfonyResponse
    {
        try {
            $action = $this->actionFactory
                ->setRequest($request)
                ->create($actionName);

            return $action->execute();
        } catch (Throwable $e) {
            return $this->exceptionHandler->handle($e);
        }
    }

    /**
     * List files in a directory
     *
     * GET /api/files?path=local://uploads
     */
    public function index(Request $request)
    {
        return $this->executeAction($request, 'index');
    }

    /**
     * Search files
     *
     * GET /api/files/search?path=local://uploads&filter=*.jpg
     */
    public function search(Request $request)
    {
        return $this->executeAction($request, 'search');
    }

    /**
     * Upload file
     *
     * POST /api/files/upload?path=local://uploads
     * Body: multipart/form-data with 'file' field
     */
    public function upload(Request $request)
    {
        return $this->executeAction($request, 'upload');
    }

    /**
     * Delete files/folders
     *
     * POST /api/files/delete?path=local://uploads
     * Body: {"items": [{"path": "local://uploads/file.txt", "type": "file"}]}
     */
    public function delete(Request $request)
    {
        return $this->executeAction($request, 'delete');
    }

    /**
     * Create new folder
     *
     * POST /api/files/newfolder?path=local://uploads
     * Body: {"name": "new-folder"}
     */
    public function createFolder(Request $request)
    {
        return $this->executeAction($request, 'create-folder');
    }

    public function createFile(Request $request)
    {
        return $this->executeAction($request, 'create-file');
    }

    /**
     * Rename file/folder
     *
     * POST /api/files/rename?path=local://uploads
     * Body: {"name": "new-name.txt", "item": "local://uploads/old-name.txt"}
     */
    public function rename(Request $request)
    {
        return $this->executeAction($request, 'rename');
    }

    /**
     * Move files/folders
     *
     * POST /api/files/move
     * Body: {"items": [...], "target": "local://uploads/destination"}
     */
    public function move(Request $request)
    {
        return $this->executeAction($request, 'move');
    }

    /**
     * Copy files/folders
     *
     * POST /api/files/copy
     * Body: {"items": [...], "target": "local://uploads/destination"}
     */
    public function copy(Request $request)
    {
        return $this->executeAction($request, 'copy');
    }

    /**
     * Download file
     *
     * GET /api/files/download?path=local://uploads/file.txt
     */
    public function download(Request $request)
    {
        return $this->executeAction($request, 'download');
    }

    /**
     * Preview file
     *
     * GET /api/files/preview?path=local://uploads/file.txt
     */
    public function preview(Request $request)
    {
        return $this->executeAction($request, 'preview');
    }

    /**
     * Save file content
     *
     * POST /api/files/save?item=local://uploads/file.txt
     * Body: {"content": "file contents"}
     */
    public function save(Request $request)
    {
        return $this->executeAction($request, 'save');
    }

    /**
     * Archive files/folders
     *
     * POST /api/files/archive
     * Body: {"items": [...], "target": "local://uploads/archive.zip"}
     */
    public function archive(Request $request)
    {
        return $this->executeAction($request, 'archive');
    }

    /**
     * Unarchive files
     *
     * POST /api/files/unarchive
     * Body: {"items": [...], "target": "local://uploads"}
     */
    public function unarchive(Request $request)
    {
        return $this->executeAction($request, 'unarchive');
    }
}

