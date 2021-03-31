<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = User::get(['uuid', 'name', 'email', 'email_verified_at', 'created_at']);
        $user->each(function($item) {
            $item->setAppends(['tanggal_bergabung']);
        });
        $user->forget('created_at');
        return $user;
    }
    
    public function headings(): array
    {
        return [
            'uuid',
            'name',
            'email',
            'email_verified_at',
            'tanggal bergabung',
        ];
    }
}
