<ul>
    @foreach(mezzo()->moduleCenter()->modules() as $module)
        <li>{{ $module->identifier() }}
            <ul>
            @foreach($module->modelReflections() as $modelReflection)
                <li>{{ $modelReflection->className() }}
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
