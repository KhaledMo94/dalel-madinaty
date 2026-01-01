<?php

namespace App\Exports;

use App\Models\Order;
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

class ModeratorOrdersExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(public $orders)
    {
        $this->orders = $orders;
    }

    public function collection(): Collection
    {
        $locale = app()->getLocale();
        return $this->orders->map(function ($order) use ($locale) {
            return [
                $order->uuid,
                $order->getTranslation('service_provider_name',$locale),
                (string) optional($order->serviceProviderBranch)->getTranslation('address',$locale),
                (string) optional($order->cashier)->name ?? $order->cashier_name,
                __("$order->status"),
                $order->sum , 
                $order->sum - $order->applicable_discount , 
                $order->applicable_discount,
                $order->applicable_discount_percentage,
                $order->profit_percentage,
                $order->profit,
                $order->created_at->format('Y-m-d'),
                $order->created_at->format('H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            __('Order ID'),
            __('Provider Name'),
            __('Branch Address'),
            __('Cashier Name'),
            __('Status'),
            __('Sum'),
            __('Paid Amount'),
            __('Discounted Amount'),
            __('Discounted Percentage'),
            __('Quick Percentage'),
            __('Quick Value'),
            __('Date'),
            __('Time'),
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
