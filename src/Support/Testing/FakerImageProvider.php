<?php

namespace Support\Testing;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function fixturesImage(string $fixturesDir, string $storageDir): string
    {
        if (!Storage::exists('images/' . $storageDir)) {
            Storage::makeDirectory('images/' . $storageDir);
        }

        $file = $this->generator->file(
            base_path("tests/Fixtures/images/$fixturesDir"),
            Storage::path('images/' . $storageDir),
            false
        );
        return '/storage/images/' . trim($storageDir, '/') . '/' . $file;
    }
}
