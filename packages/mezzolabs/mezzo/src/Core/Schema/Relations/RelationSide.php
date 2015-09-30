<?php


namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class RelationSide {
    /**
     * @var Relation
     */
    protected $relation;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var boolean
     */
    protected $hasOneChild;

    /**
     * Creates a new relation side. Can tell you if this side of the relation has one or many "children"
     *
     * @param Relation $relation
     * @param string $table
     */
    public function __construct(Relation $relation, $table){

        $this->relation = $relation;
        $this->table = $table;

        $this->hasOneChild = $this->hasOneChild();
    }

    /**
     * @return bool
     */
    public function hasMultipleChildren(){
        return !$this->hasOneChild();
    }

    /**
     * @return bool
     */
    public function hasOneChild(){
        if($this->hasOneChild === null){
            $this->hasOneChild = $this->getType() === "single";
        }

        return $this->hasOneChild;
    }

    /**
     * Check if this relation side has one or many "children".
     *
     * @return string
     */
    protected function getType(){
        if($this->relation instanceof ManyToMany)
            return "multiple";

        if($this->relation instanceof OneToOne)
            return "single";

        if($this->relation instanceof OneToMany){
            /**
             * If the connecting table is on our side we only have one child.
             */
            if($this->relation->connectingTable() === $this->table)
                return "single";
            else
                return "multiple";
        }

        return "multiple";
    }

    /**
     * @return Relation
     */
    public function relation()
    {
        return $this->relation;
    }
} 