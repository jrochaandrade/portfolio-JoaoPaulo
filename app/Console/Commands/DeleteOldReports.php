<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\PhotographicReport\Models\PhotographicReport;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DeleteOldReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete reports older than 30 days along with ther photos';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateThreshold = Carbon::now()->subDays(35);
        $oldReports = PhotographicReport::with('photos')->where('created_at', '<', $dateThreshold)->get();

        if ($oldReports->isEmpty()) {
            $this->info('No reports older than 35 days found');
            Log::info('No reports older tha 35 days found');
            return;
        }

        foreach ($oldReports as $report) {
            Log::info('Deletind report ID: '. $report->id);

            foreach ($report->photos as $photo) {
                if (Storage::disk('public')->exists($photo->path)) {
                    Storage::disk('public')->delete($photo->path);
                }
                $photo->delete();
            }

            $report->delete();
            /* foreach ($oldReports as $report) {
                // Delete associated photos
                foreach ($report->photos as $photo) {
                    Storage::delete($photo->path);
                    $photo->delete();
                }
                // Delete the report itself
                $report->delete();
         */
        }

        $this->info('Old reports and their photos have been deleted');
    }
}