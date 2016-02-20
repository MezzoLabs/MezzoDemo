<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoImageFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Core\Files\Types\ImageFileType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\IsFileWithType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\TypedFileAddon;

class ImageFile extends MezzoImageFile implements TypedFileAddon
{
    use IsFileWithType;

    protected $fileType = ImageFileType::class;

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * Delete the the parent file only.
     * The database will delete this image file via the cascade.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        return $this->file->delete();
    }

    /**
     * @return FileType
     */
    public function fileType()
    {
       return new ImageFileType();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'main_image_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'image_file_product', 'image_file_id', 'product_id');
    }

    public function events()
    {
        return $this->belongsToMany(\App\Event::class, 'event_image_file', 'image_file_id', 'event_id');
    }

    public function url($size = "medium")
    {
        return $this->file->url() . '?size=' . $size;
    }

}
