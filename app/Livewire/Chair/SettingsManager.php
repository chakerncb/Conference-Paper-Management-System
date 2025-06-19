<?php

namespace App\Livewire\Chair;

use Livewire\Component;
use App\Models\ConferenceSetting;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class SettingsManager extends Component
{
    public $settings = [];
    public $activeTab = 'general';

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $allSettings = ConferenceSetting::all();
        
        foreach ($allSettings as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updateSettings()
    {
        $this->validate([
            'settings.conference_name' => 'required|string|max:255',
            'settings.conference_acronym' => 'required|string|max:10',
            'settings.conference_year' => 'required|numeric|min:2024',
            'settings.submission_deadline' => 'required|date',
            'settings.review_deadline' => 'required|date|after:settings.submission_deadline',
            'settings.camera_ready_deadline' => 'required|date|after:settings.review_deadline',
            'settings.registration_deadline' => 'required|date|after:settings.camera_ready_deadline',
            'settings.max_paper_size_mb' => 'required|numeric|min:1|max:50',
            'settings.reviews_per_paper' => 'required|numeric|min:1|max:10',
        ]);

        foreach ($this->settings as $key => $value) {
            ConferenceSetting::where('key', $key)->update(['value' => $value]);
        }

        LivewireAlert::success()
            ->title('Success!')
            ->text('Settings updated successfully!');
    }

    public function resetToDefaults()
    {
        // Reset to default values
        $this->settings = [
            'conference_name' => 'International Conference on Computer Science',
            'conference_acronym' => 'ICCS',
            'conference_year' => '2025',
            'conference_location' => 'University Campus',
            'conference_website' => 'https://conference.example.com',
            'submission_deadline' => '2025-08-15',
            'review_deadline' => '2025-09-30',
            'camera_ready_deadline' => '2025-11-15',
            'registration_deadline' => '2025-12-01',
            'conference_description' => 'A premier international conference bringing together researchers and practitioners in computer science.',
            'submission_guidelines' => 'Papers should be submitted in PDF format, maximum 8 pages, using the provided template.',
            'review_criteria' => 'Papers will be reviewed based on originality, technical quality, clarity, and relevance.',
            'keywords' => 'Computer Science, Machine Learning, AI, Software Engineering, Data Science',
            'max_paper_size_mb' => '10',
            'reviews_per_paper' => '3',
            'enable_blind_review' => '1',
        ];

        LivewireAlert::info()
            ->title('Reset Complete')
            ->text('Settings reset to defaults. Click "Save Changes" to apply.');
    }

    public function render()
    {
        $settingsGroups = ConferenceSetting::all()->groupBy('group');
        
        return view('livewire.chair.settings-manager', [
            'settingsGroups' => $settingsGroups
        ]);
    }
}
