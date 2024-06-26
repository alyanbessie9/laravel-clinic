<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BlogPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
   

    protected static ?string $chartId = 'visitorsChart';

    

    /**
     * Widget Title
     *
     * @var string|null
     */
    

    protected static ?string $heading = 'Patient Appointment';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
                'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Visitors',
                    'data' => [150, 200, 300, 400, 500, 600, 700],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            ],
            'colors' => ['#10b981'],
            ];
    }
}
