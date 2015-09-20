<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\OneToMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\OneToOne;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;
use MezzoLabs\Mezzo\Exceptions\InvalidArgument;

class RelationConverter
{

    /**
     * Convert RelationshipReflection to Relation
     *
     * Examples:
     * One To One
     * $women->belongsTo('Man')  --> womens.man_id + man.id
     * $man->hasOne('Woman')     --> man.id + womens.man_id
     *
     * One To Many
     * $event->belongsTo('Course')  --> events.course_id + courses.id
     * $course->hasMany('Event')    --> courses.id + events.course_id
     *
     * Many To Many
     * $user->belongsToMany('Role') --> user_roles.role_id + user_roles.user_id
     * $role->belongsToMany('User') --> user_roles.role_id + user_roles.user_id
     *
     *
     * @param RelationshipReflection $reflection
     * @throws \ReflectionException
     * @return Relation
     */
    public static function fromReflectionToRelation(RelationshipReflection $reflection)
    {
        switch ($reflection->type()) {
            case 'BelongsTo':
                $relation = static::fromBelongsTo($reflection);
                break;
            case 'BelongsToMany':
                $relation = new ManyToMany($reflection->tableName(), $reflection->relatedTableName());
                $relation->setPivot($reflection->instance()->getTable(),
                    $reflection->instance()->getForeignKey(),
                    $reflection->instance()->getOtherKey());
                break;
            case 'HasOne':
                $relation = new OneToOne($reflection->relatedTableName(), $reflection->tableName());
                $relation->connectVia($reflection->relatedColumn());
                break;
            case 'HasMany':
                $relation = new OneToMany($reflection->relatedTableName(), $reflection->tableName());
                $relation->manySide($reflection->relatedColumn());
                break;
            default:
                throw new \ReflectionException('Relation is not supported ' . $reflection->qualifiedName());
        }

        return $relation;
    }

    /**
     * Create a OneToOne or a OneToMany relation from a relation reflection.
     *
     * belongsTo + hasOne = OneToOne
     * belongsTo + hasMany = OneToMany
     *
     * @param RelationshipReflection $reflection
     * @return \MezzoLabs\Mezzo\Core\Schema\Relations\OneToMany|\MezzoLabs\Mezzo\Core\Schema\Relations\OneToOne
     * @throws \ReflectionException
     */
    public static function fromBelongsTo(RelationshipReflection $reflection)
    {
        if (!$reflection->is('BelongsTo')) throw new InvalidArgument($reflection);

        $counterpart = $reflection->counterpart();

        if (!$counterpart) {
            throw new \ReflectionException('Cannot find a counterpart to ' . $reflection->qualifiedName() . '. ' .
                'Please set up the inverse relation in ' . get_class($reflection->instance()->getRelated()));
        }

        if ($counterpart->is('HasOne')) {
            $relation = new OneToOne($reflection->tableName(), $reflection->relatedTableName());
            $relation->connectVia($reflection->localColumn());
        } else {
            $relation = new OneToMany($reflection->tableName(), $reflection->relatedTableName());
            $relation->manySide($reflection->localColumn());
        }

        return $relation;
    }
}