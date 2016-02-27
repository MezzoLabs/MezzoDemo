<?php


namespace App\Magazine\Shop\Http\Pages\Voucher;


use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumn;
use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumns;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;

class IndexVoucherPage extends IndexResourcePage
{
    public function columns() : IndexTableColumns
    {
        $columns = parent::columns();

        $columns['_redeemers_amount'] = IndexTableColumn::makeFromCalculatedValue('_redeemers_amount', 'Redeemers', \Doctrine\DBAL\Types\Type::INTEGER);

        return $columns;
    }
}