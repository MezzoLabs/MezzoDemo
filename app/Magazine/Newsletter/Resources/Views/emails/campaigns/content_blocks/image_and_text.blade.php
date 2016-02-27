@if ($block->getOption('image_position') == "above")
    <img src="{{ $block->getImage()->url() }}"/>

    <div class=text">{!! $block->getFieldValue('text') !!}</div>
@endif

@if ($block->getOption('image_position') == "right")
    <table>
        <tr>
            <td width="50%">
                <div class=text">{!! $block->getFieldValue('text') !!}</div>
            </td>
            <td width="50%">
                <img src="{{ $block->getImage()->url() }}"/>

            </td>
        </tr>
    </table>
@endif

@if ($block->getOption('image_position') == "left")
    <table>
        <tr>
            <td width="50%">
                <img src="{{ $block->getImage()->url() }}"/>
            </td>
            <td width="50%">
                <div class=text">{!! $block->getFieldValue('text') !!}</div>

            </td>
        </tr>
    </table>
@endif

@if ($block->getOption('image_position') == "below")

    <div class=text">{!! $block->getFieldValue('text') !!}</div>
    <img src="{{ $block->getImage()->url() }}"/>

@endif

