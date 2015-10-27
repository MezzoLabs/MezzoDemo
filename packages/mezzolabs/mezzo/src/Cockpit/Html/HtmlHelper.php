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

    public function sidebar()
    {
        return new SidebarHelper();
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
}