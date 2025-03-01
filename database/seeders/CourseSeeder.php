<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define local image directory (update this path as needed)
        $localImagePath = 'C:/Users/hp/OneDrive/Desktop/knowledgepride_image/'; // Update to match your actual folder

        // Ensure storage directory exists
        Storage::disk('public')->makeDirectory('courses');

        // Define courses with corresponding images
        $courses = [
            [
                'course_full_name' => 'Project Management Professional',
                'slug' => 'project-management-professional',
                'course_short_name' => 'PMP',
                'category_id' => 1, // Ensure this category exists
                'course_icons' => 'pmp.png', // Local image file
                'course_banners' => 'course-banner.jpg', // Local banner image
                'short_description' => 'Project Management Professional (PMP)® certification is the most distinguished professional qualification for project managers offered by Project Management Institute (PMI)®.',
                'is_active' => true,
                'admin_id' => 1, // Ensure this admin exists
            ],
            [
                'course_full_name' => 'Microsoft Project 2016',
                'slug' => 'microsoft-project-2016',
                'course_short_name' => 'MSP',
                'category_id' => 1,
                'course_icons' => 'msp.png',
                'course_banners' => null, // No banner image for this course
                'short_description' => 'Microsoft Project 2013/16 will help participants get hands-on familiarity with Project 2013/16.',
                'is_active' => true,
                'admin_id' => 1,
            ],
        ];

        foreach ($courses as $course) {
            // Handle local image paths
            $imagePath = $course['course_icons'] ? $localImagePath . $course['course_icons'] : null;
            $bannerImagePath = $course['course_banners'] ? $localImagePath . $course['course_banners'] : null;

            // Copy images to Laravel storage if they exist
            $imageDestination = null;
            $bannerImageDestination = null;

            if ($imagePath && File::exists($imagePath)) {
                $imageDestination = 'courses/' . $course['course_icons'];
                Storage::disk('public')->put($imageDestination, File::get($imagePath));
            }

            if ($bannerImagePath && File::exists($bannerImagePath)) {
                $bannerImageDestination = 'courses/' . $course['course_banners'];
                Storage::disk('public')->put($bannerImageDestination, File::get($bannerImagePath));
            }

            // Insert course into the database
            DB::table('courses')->insert([
                'course_full_name' => $course['course_full_name'],
                'slug' => $course['slug'],
                'course_short_name' => $course['course_short_name'],
                'category_id' => $course['category_id'],
                'image' => $imageDestination, // Save relative path in DB
                'banner_image' => $bannerImageDestination, // Save relative path in DB
                'short_description' => $course['short_description'],
                'is_active' => $course['is_active'],
                'admin_id' => $course['admin_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
