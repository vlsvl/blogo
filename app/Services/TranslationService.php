<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class TranslationService
{
    public function getTranslations(string $locale): array
    {
        return array_merge(
            $this->getPhpTranslations($locale),
            $this->getJsonTranslations($locale)
        );
    }

    private function getPhpTranslations(string $locale): array
    {
        if (File::exists(base_path("lang/$locale"))) {
            $phpTranslations = collect(File::allFiles(base_path("lang/$locale")))
                ->filter(fn ($file) => $file->getExtension() === 'php')
                ->flatMap(fn ($file) => Arr::dot(File::getRequire($file->getRealPath())));
        }
        return !empty($phpTranslations) ? $phpTranslations->toArray() : [];
    }

    private function getJsonTranslations(string $locale): array
    {
        if (File::exists(base_path("lang/$locale.json"))) {
            $jsonTranslations = json_decode(File::get(base_path("lang/$locale.json")), true);
        }
        return $jsonTranslations ?? [];
    }
}
