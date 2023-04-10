<?php

namespace App\Enums;

use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToReadFile;

enum LogoImage: string
{
    case SeniorCrest = 'senior-crest.png';
    case PrepCrest = 'prep-crest.png';

    private function getDisk(): FilesystemAdapter
    {
        return Storage::disk('logos');
    }

    public function getPath(): string
    {
        if ($this->getDisk()->exists($this->value)) {
            return $this->getDisk()->path($this->value);
        }
        throw new UnableToReadFile('File does not exist: '.$this->value);
    }

    public function getImage(): string
    {
        return $this->getDisk()->get($this->value);
    }

    public function getMimeType(): string
    {
        return $this->getDisk()->mimeType($this->value);
    }

    public function lastModified(): Carbon
    {
        return Carbon::parse($this->getDisk()->lastModified($this->value));
    }

}
