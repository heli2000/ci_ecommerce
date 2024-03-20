<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FileController extends BaseController
{
    public function download()
    {
        $filename = $this->request->uri->getSegments();

        array_shift($filename); // Remove 'file'
        array_shift($filename); // Remove 'download'

        // Construct the filename from the remaining segments
        $filename = implode('/', $filename);

        // Validate the filename to prevent directory traversal attacks
        if (!preg_match('/^[a-zA-Z0-9_\-\/\.]+$/', $filename)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mimeType = mime_content_type($path);

        // Set headers
        $this->response->setHeader('Content-Type', $mimeType);
        $this->response->setHeader('Content-Disposition', 'inline');

        $this->response->setBody(file_get_contents($path));


        return $this->response;
    }
}
