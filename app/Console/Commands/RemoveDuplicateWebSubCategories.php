<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\WebDirectorySubCategory;
use Illuminate\Support\Facades\DB;

class RemoveDuplicateWebSubCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:remove-duplicate-web-subcategories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate WebDirectorySubCategory records based on sub_category_name while keeping one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🔍 Checking for duplicate subcategories...");

        // Get all names that appear more than once
        $duplicates = WebDirectorySubCategory::select('sub_category_name', DB::raw('COUNT(*) as count'))
            ->groupBy('sub_category_name')
            ->having('count', '>', 1)
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info("✅ No duplicate subcategories found!");
            return;
        }

        foreach ($duplicates as $dup) {
            $this->info("🧹 Cleaning duplicates for: {$dup->sub_category_name}");

            // Get all records with that name
            $records = WebDirectorySubCategory::where('sub_category_name', $dup->sub_category_name)
                ->orderBy('id', 'asc')
                ->get();

            // Keep the first one, delete the rest
            $toKeep = $records->shift();
            $toDelete = $records->pluck('id')->toArray();

            WebDirectorySubCategory::whereIn('id', $toDelete)->delete();

            $this->info("✅ Kept ID: {$toKeep->id}, Deleted IDs: " . implode(', ', $toDelete));
        }

        $this->info("🎯 Duplicate cleanup completed successfully!");
    }
}
