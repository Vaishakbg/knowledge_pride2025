<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define local image directory (update this path as needed)
        $localImagePath = 'C:/Users/hp/OneDrive/Desktop/knowledgepride_image/'; // Change to your actual desktop folder path

        // Ensure storage directory exists
        Storage::disk('public')->makeDirectory('course_categories');

        // Define course categories with corresponding images
        $categories = [
            ['name' => 'Project Management', 'slug' => 'project-management', 'image' => 'project-management.webp'],
            ['name' => 'Business and Leadership', 'slug' => 'business-and-leadership', 'image' => 'Business-and-Leadership.webp'],
            ['name' => 'Agile and Scrum', 'slug' => 'agile-and-scrum', 'image' => 'Agile-and-Scrum.png']
        ];

        foreach ($categories as $category) {
            // Check if image exists in the local directory
            $sourcePath = $localImagePath . $category['image'];
            if (File::exists($sourcePath)) {
                // Copy image to Laravel storage
                $destinationPath = 'course_categories/' . $category['image'];
                Storage::disk('public')->put($destinationPath, File::get($sourcePath));
            } else {
                $destinationPath = null; // Set to null if image not found
            }

            // Insert category into the database
            DB::table('course_categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'image' => $destinationPath, // Save relative path
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
