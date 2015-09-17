<h3>Reflection</h3>
<ul>
    <li>
        Eloquent:
        <ul>
            @foreach(mezzo()->reflector()->eloquentModels() as $eloquent)
                <li>{{ $eloquent }}</li>
            @endforeach
        </ul>
    </li>
    <li>
        Mezzo Traits:
        <ul>
            @foreach(mezzo()->reflector()->mezzoModels() as $eloquent)
                <li>{{ $eloquent }}</li>
            @endforeach
        </ul>
    </li>
    <li>
        Reflections:
        <ul>
            @foreach(mezzo()->reflector()->reflections() as $reflection)
                <li>{{ $reflection->className() }}</li>
            @endforeach
        </ul>
    </li>

</ul>

<h3>Modules</h3>

<ul>
    @foreach(mezzo()->moduleCenter()->modules() as $module)
        <li><b>{{ $module->slug() }}</b> ({{ $module->identifier() }})
            <ul>
            @foreach($module->models() as $modelReflection)
                <li><b>{{ $modelReflection->shortName() }}</b> ({{ $modelReflection->className() }})

                    <ul>
                        <li>
                            Columns:
                            <ul>
                            @foreach($modelReflection->table()->columns() as $column)
                            <li>{{ $column->name() }}</li>
                            @endforeach
                            </ul>
                        </li>
                        <li>
                            Relations:
                            <ul>
                            @foreach($modelReflection->relationships() as $relationship)
                            <li>{{ $relationship->name() }}</li>
                            @endforeach
                            </ul>
                        </li>

                    </ul>
                </li>
            @endforeach
            </ul>
        </li>
    @endforeach


</ul>
