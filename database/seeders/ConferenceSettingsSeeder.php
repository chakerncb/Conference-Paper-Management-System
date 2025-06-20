<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConferenceSetting;

class ConferenceSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'conference_name', 'value' => 'International Conference on Computer Science', 'type' => 'text', 'group' => 'general'],
            ['key' => 'conference_acronym', 'value' => 'ICCS', 'type' => 'text', 'group' => 'general'],
            ['key' => 'conference_year', 'value' => '2025', 'type' => 'number', 'group' => 'general'],
            ['key' => 'conference_location', 'value' => 'University 8 Mai 1945 Guelma', 'type' => 'text', 'group' => 'general'],
            ['key' => 'conference_website', 'value' => 'https://conference.example.com', 'type' => 'text', 'group' => 'general'],
            
            // Deadlines
            ['key' => 'submission_deadline', 'value' => '2025-08-15', 'type' => 'date', 'group' => 'deadlines'],
            ['key' => 'review_deadline', 'value' => '2025-09-30', 'type' => 'date', 'group' => 'deadlines'],
            ['key' => 'camera_ready_deadline', 'value' => '2025-11-15', 'type' => 'date', 'group' => 'deadlines'],
            ['key' => 'registration_deadline', 'value' => '2025-12-01', 'type' => 'date', 'group' => 'deadlines'],
            
            // Content Settings
            ['key' => 'conference_description', 'value' => 'A premier international conference bringing together researchers and practitioners in computer science.', 'type' => 'textarea', 'group' => 'content'],
            ['key' => 'submission_guidelines', 'value' => 'Papers should be submitted in PDF format, maximum 8 pages, using the provided template.', 'type' => 'textarea', 'group' => 'content'],
            ['key' => 'review_criteria', 'value' => 'Papers will be reviewed based on originality, technical quality, clarity, and relevance.', 'type' => 'textarea', 'group' => 'content'],
            ['key' => 'keywords', 'value' => 'Computer Science, Machine Learning, AI, Software Engineering, Data Science', 'type' => 'text', 'group' => 'content'],
            
            // System Settings
            ['key' => 'max_paper_size_mb', 'value' => '10', 'type' => 'number', 'group' => 'system'],
            ['key' => 'reviews_per_paper', 'value' => '3', 'type' => 'number', 'group' => 'system'],
            ['key' => 'enable_blind_review', 'value' => '1', 'type' => 'checkbox', 'group' => 'system'],
        ];

        foreach ($settings as $setting) {
            ConferenceSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
