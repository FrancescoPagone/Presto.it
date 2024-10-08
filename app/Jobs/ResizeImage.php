<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Enums\Unit;
use Illuminate\Bus\Queueable;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $filePath,
        private int $width,
        private int $height
    ) {}



    public function handle(): void
    {
        $srcPath = storage_path('app/public/' . $this->filePath);
        $destPath = storage_path("app/public/" . dirname($this->filePath) . "/crop_{$this->width}x{$this->height}_" . basename($this->filePath));

        if (!file_exists($srcPath)) {
            throw new \Exception("Source file does not exist: {$srcPath}");
        }

        Image::load($srcPath)
            ->crop($this->width, $this->height, CropPosition::Center)
            ->watermark(
                public_path('/img/LOGOpresto.png'),
                width: 50,
                height: 50,
                paddingX: 5,
                paddingY: 5,
                paddingUnit: Unit::Percent,
            )
            ->save($destPath);
    }
}
