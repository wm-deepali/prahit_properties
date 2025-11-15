<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BusinessListing;
use Illuminate\Support\Str;

class GenerateBusinessSlugs extends Command
{
    protected $signature = 'business:generate-slugs';
    protected $description = 'Generate SEO-friendly slugs for existing businesses';

    public function handle()
    {
        $this->info('Generating slugs for businesses...');

        $businesses = BusinessListing::all();
        $count = 0;

        foreach ($businesses as $business) {
            // Only generate slug if it's empty
            if (!$business->slug) {
                $slug = Str::slug($business->business_name);

                // Ensure uniqueness
                $originalSlug = $slug;
                $i = 1;
                while (BusinessListing::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $i;
                    $i++;
                }

                $business->slug = $slug;
                $business->save();
                $count++;
                $this->info("Generated slug for: {$business->business_name} -> {$slug}");
            }
        }

        $this->info("Done! Total slugs generated: {$count}");
    }
}
