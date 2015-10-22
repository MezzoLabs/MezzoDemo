<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Html;


interface ModulePageContract
{
    public function slug();

    public function title();

    public function name();

    public function qualifiedName();

    public function template();
}