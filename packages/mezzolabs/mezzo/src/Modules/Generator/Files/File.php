<?php


namespace MezzoLabs\Mezzo\Modules\Generator\File;


class File {
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
     */
    public function save(){
        throw new \Exception('todo');
    }
} 