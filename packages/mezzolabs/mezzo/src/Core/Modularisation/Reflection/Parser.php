<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;

class Parser {
    /**
     * @var ModelReflection
     */
    protected $modelReflection;

    /**
     * @param ModelReflection $modelReflection
     */
    public function __construct(ModelReflection $modelReflection){

        $this->modelReflection = $modelReflection;
    }

    public function tokenStream(){
        $fileName = $this->modelReflection->fileName();

        Singleton::get('tokens.' . $fileName,
            function() use ($fileName){
                return static::tokensFromFile($fileName);
            });
    }


    public static function tokensFromFile($fileName){
        $allTokens = token_get_all($fileName);

        $tokens = new Collection();

        foreach($allTokens as $token){

        }
    }

}