<?php


namespace MezzoLabs\Mezzo\Cockpit\Html;

class HtmlHelper
{
    /**
     * Buffer for css classes
     *
     * @var array
     */
    protected $cssClasses = [];

    /**
     * Buffer for HTML content.
     *
     * @var string
     */
    protected $content = '';

    public function sidebar()
    {
        $this->resetBuffers();
        return new SidebarHelper();
    }

    public function table($array = null)
    {
        $this->resetBuffers();
        $tableHelper = new TableHelper($array);
        return $tableHelper->render();
    }

    public function css($key, $parameters)
    {
        $this->startNewCssClass();

        if($key == 'sidebar')
            return $this->sidebar()->cssClass($parameters);
    }

    protected function cssClassString()
    {
        $string =  implode(' ', $this->cssClasses);
        $this->startNewCssClass();
        return $string;
    }

    protected function startNewCssClass()
    {
        $this->cssClasses = [];
    }

    /**
     * @param $class
     */
    protected function addCssClass($class){
        $this->cssClasses[] = $class;
    }

    protected function decideCssClass($decision, $class1, $class2){
        if($decision)
            $this->addCssClass($class1);
        else
            $this->addCssClass($class2);
    }

    protected function addContent($content){
        $this->content .= $content;
    }

    protected function finishContent(){
        $content = $this->content;

        $this->content = "";
        return $content;
    }

    /**
     * Checks if a section is set in the child template.
     *
     * @param $sectionName
     * @return bool
     */
    public function sectionExists($sectionName){
        return array_key_exists('content-aside', \View::getSections());
    }

    protected function resetBuffers(){
        $this->startNewCssClass();
        $this->content = '';
    }
}