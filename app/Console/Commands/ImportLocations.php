<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Locations;

class ImportLocations extends Command
{
    protected $signature = 'import:locations';
    protected $description = 'Import Locations from CSV file';

    public function handle()
    {
        $path = storage_path('app/imports/locations.csv');

        if (!file_exists($path)) {
            $this->error("File not found at $path");
            return 1;
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            $this->error("Cannot open the file");
            return 1;
        }

        $headers = fgetcsv($handle);
        $count = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            $exists = Locations::where('location', $data['location'])
                ->where('city_id', $data['city_id'])
                ->exists();

            if (!$exists) {
                Locations::create([
                    'state_id' => $data['state_id'],
                    'city_id' => $data['city_id'],
                    'location' => $data['location'],
                    'status' => $data['status'],
                ]);
                $count++;
                $this->info("Inserted location: " . $data['location']);
            } else {
                $this->line("Location exists: " . $data['location']);
            }
        }

        fclose($handle);

        $this->info("Import finished. Total new locations added: $count");
        return 0;
    }
}
