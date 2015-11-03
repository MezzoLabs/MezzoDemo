<?php


namespace MezzoLabs\Mezzo\Core\Files;


use MezzoLabs\Mezzo\Modules\Generator\CannotGenerateFileException;

class File
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $filename
     * @param string $content
     */
    public function __construct($filename, $content)
    {
        $this->filename = $filename;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Save the file under the given filename.
     *
     * @throws \Exception
     * @return boolean
     */
    public function save()
    {

        $saved = StorageFactory::root()->put($this->filename(), $this->content());

        if (!$saved) throw new CannotGenerateFileException($this->filename . ' cannot be written.');

        return true;
    }

    public function dump()
    {
        echo "<pre>";
        echo $this->filename() . "\r\n";
        var_export($this->content());
        echo "</pre>";
    }
} 