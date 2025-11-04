<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ozdemir\VueFinder\Actions\VueFinderActionFactory;

class VueFinderController extends Controller
{
    /**
     * Inject the action factory via constructor
     */
    public function __construct(
        private VueFinderActionFactory $actionFactory
    ) {}

    /**
     * List files in a directory
     *
     * GET /api/files?path=local://uploads
     */
    public function index(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('index');

        return $action->execute();
    }

    /**
     * Search files
     *
     * GET /api/files/search?path=local://uploads&filter=*.jpg
     */
    public function search(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('search');

        return $action->execute();
    }

    /**
     * Upload file
     *
     * POST /api/files/upload?path=local://uploads
     * Body: multipart/form-data with 'file' field
     */
    public function upload(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('upload');

        return $action->execute();
    }

    /**
     * Delete files/folders
     *
     * POST /api/files/delete?path=local://uploads
     * Body: {"items": [{"path": "local://uploads/file.txt", "type": "file"}]}
     */
    public function delete(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('delete');

        return $action->execute();
    }

    /**
     * Create new folder
     *
     * POST /api/files/newfolder?path=local://uploads
     * Body: {"name": "new-folder"}
     */
    public function createFolder(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('create-folder');

        return $action->execute();
    }

    public function createFile(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('create-file');

        return $action->execute();
    }

    /**
     * Rename file/folder
     *
     * POST /api/files/rename?path=local://uploads
     * Body: {"name": "new-name.txt", "item": "local://uploads/old-name.txt"}
     */
    public function rename(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('rename');

        return $action->execute();
    }

    /**
     * Move files/folders
     *
     * POST /api/files/move
     * Body: {"items": [...], "target": "local://uploads/destination"}
     */
    public function move(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('move');

        return $action->execute();
    }

    /**
     * Copy files/folders
     *
     * POST /api/files/copy
     * Body: {"items": [...], "target": "local://uploads/destination"}
     */
    public function copy(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('copy');

        return $action->execute();
    }

    /**
     * Download file
     *
     * GET /api/files/download?path=local://uploads/file.txt
     */
    public function download(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('download');

        return $action->execute();
    }

    /**
     * Preview file
     *
     * GET /api/files/preview?path=local://uploads/file.txt
     */
    public function preview(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('preview');

        return $action->execute();
    }

    /**
     * Save file content
     *
     * POST /api/files/save?item=local://uploads/file.txt
     * Body: {"content": "file contents"}
     */
    public function save(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('save');

        return $action->execute();
    }

    /**
     * Archive files/folders
     *
     * POST /api/files/archive
     * Body: {"items": [...], "target": "local://uploads/archive.zip"}
     */
    public function archive(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('archive');

        return $action->execute();
    }

    /**
     * Unarchive files
     *
     * POST /api/files/unarchive
     * Body: {"items": [...], "target": "local://uploads"}
     */
    public function unarchive(Request $request)
    {
        $action = $this->actionFactory
            ->setRequest($request)
            ->create('unarchive');

        return $action->execute();
    }
}

