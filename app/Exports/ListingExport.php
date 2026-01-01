<?php

namespace App\Exports;

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

class ListingExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(public $listings)
    {
        $this->listings = $listings;
    }

    public function collection(): Collection
    {
        $locale = app()->getLocale();
        return $this->listings->map(function ($listing) use ($locale) {
            return [
                $listing->getTranslation('name',$locale),
                $listing->getTranslation('description',$locale),
                $listing->category?->getTranslation('description',$locale) ?? __('Uncategorized'),
                $listing->status == 'active' ? __('Active') : __('Inactive'),
                $listing->created_at->format('Y-m-d'), 
                $listing->user?->name ?? __('Created By Admin'),
                $listing->user?->phone ? "\t".$listing->user->phone :__('Created By Admin'),
                $listing->user?->is_phone_verified ?? __('Created By Admin'),
                $listing->user?->saleCode->name ?? __('Created By Admin'),
                $listing->users_count ?? "\t". "0",
                $listing->branches_count ?? "\t". "0",
                $listing->user?->latestValidPurchase?->start_date?->format('Y-m-d') ?? 'No Paid Purchase',
                $listing->user?->latestValidPurchase?->end_date?->format('Y-m-d') ?? 'No Paid Purchase',
                $listing->user?->latestValidPurchase?->paid_amount ?? 'No Paid Purchase',
            ];
        });
    }

    public function headings(): array
    {
        return [
            __('Listing Name'),
            __('Listing Description'),
            __('Category Name'),
            __('Status'),
            __('Joined At'),
            __('Owner Name'),
            __('Owner Phone'),
            __('Is Phone Verified'),
            __('Sales Code Used'),
            __('Likes Count'),
            __('Branches Count'),
            __('Start Date'),
            __('End Date'),
            __('Paid Amount'),
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
        return 'Orders Sheet';
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
