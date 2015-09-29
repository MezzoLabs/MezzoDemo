<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use MezzoLabs\Mezzo\Core\Files\File;

abstract class FileSchema {
    abstract public function content();

    abstract protected function templateName();

    /**
     * The file name of the according file.
     *
     * @return string
     */
    abstract protected function shortFileName();

    /**
     * Adds the template name to the template directory.
     *
     * @return string
     */
    protected function fullTemplateName(){
        return 'modules.generator::templates.' . $this->templateName();
    }

    /**
     * Returns the filled out template.
     *
     * @param $data
     * @return string
     */
    protected function fillTemplate($data){
        $viewFactory = mezzo()->makeViewFactory();

        $templateData = [
            'PHP_OPENING_TAG' => '<?php'
        ];

        return $viewFactory->make($this->fullTemplateName(), $data, $templateData)->render();
    }


    /**
     * Returns a File instance. The content is the filled out template.
     *
     * @param $folder
     * @return \MezzoLabs\Mezzo\Core\Files\File
     */
    public function file($folder){
        return new File($folder .'/'. $this->shortFileName(), $this->content());
    }

} 