<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithStyles,
    WithTitle,
    ShouldAutoSize,
    WithEvents
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize, WithEvents
{
    public function __construct()
    {
        
    }
    public function collection(): Collection
    {
        return User::withCount([
            'reviews',
            'serviceProviders',
        ])->whereDoesntHave('roles')
        ->get()->map(function ($user) {
            return [
                $user->name,
                $user->email,
                (string) $user->phone,
                $user->is_phone_verified ? __('Yes') : __('No'),
                $user->is_email_verified ? __('Yes') : __('No'),
                $user->status == 'active' ? __('Yes') : __('No'),
                $user->created_at->format('Y-m-d H:i:s'),
                $user->reviews_count,
                $user->serviceProviders_count,
            ];
        });
    }

    public function headings(): array
    {
        return [
            __('Name'),
            __('Email'),
            __('Phone'),
            __('Is Phone Verified'),
            __('Is Email Verified'),
            __('Is Active'),
            __('Joined At'),
            __('Reviews Count'),
            __('Liked Providers Count')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function title(): string
    {
        return 'Users Sheet';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:I1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => '#FFFF00'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            }
        ];
    }


}
