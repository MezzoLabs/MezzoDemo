<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


abstract class Schema {
    abstract public function content();

    abstract protected function templateName();

    /**
     * Adds the template name to the template directory.
     *
     * @return string
     */
    protected function fullTemplateName(){
        return 'modules_generator::templates.' . $this->templateName();
    }

    /**
     * Returns the filled out template.
     *
     * @param $data
     * @return \Illuminate\Contracts\View\View
     */
    protected function makeTemplate($data){
        $viewFactory = mezzo()->makeViewFactory();
        return $viewFactory->make($this->fullTemplateName(), $data);
    }

} 