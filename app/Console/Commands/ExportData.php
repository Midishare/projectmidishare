<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [

            
        ];
        
        // Masukkan data yang ingin diekspor ke dalam array ini

        Excel::create('data_export', function($excel) use ($data) {
            $excel->sheet('Sheet1', function($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
        
        $this->info('Data has been exported successfully.');
    }
}
