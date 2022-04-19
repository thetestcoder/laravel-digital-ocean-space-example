<?php

namespace App\Http\Controllers;

use App\Models\File;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Psr7\mimetype_from_filename;

class FileController extends Controller
{
    const PATH = "/test/";

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $file = new File();

        $uploadedFile = $request->file('file');

        $file->name = $uploadedFile->getClientOriginalName();
        $file->url = self::PATH . $uploadedFile->getClientOriginalName();
        $file->save();

        Storage::disk('digital_space')->put($file->url, @file_get_contents($uploadedFile));

        return back();
    }

    public function getFile(File $file)
    {
        $remote_file = Storage::disk('digital_space')->get($file->url);

        $mimetype = MimeType::fromFilename($file->name);
        $headers = [
            'Content-Type' => $mimetype,
        ];
        return response($remote_file, 200, $headers);
    }
}
