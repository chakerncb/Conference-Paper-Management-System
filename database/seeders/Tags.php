<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tags extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tags = [
            'Artificial Intelligence',
            'Machine Learning',
            'Deep Learning',
            'Neural Networks',
            'Computer Vision',
            'Natural Language Processing',
            'Data Science',
            'Algorithm Design',
            'Software Engineering',
            'Web Development',
            'Mobile Development',
            'Database Systems',
            'Cloud Computing',
            'Cybersecurity',
            'Blockchain Technology',
            'Internet of Things',
            'Big Data Analytics',
            'DevOps',
            'User Experience Design',
            'Quantum Computing'
        ];

        $descriptions = [
            'Exploring the principles and applications of AI.',
            'Techniques and algorithms for machine learning.',
            'Advanced methods in deep learning.',
            'Understanding neural networks and their architectures.',
            'Techniques for processing and analyzing visual data.',
            'Methods for understanding and generating human language.',
            'Statistical methods for extracting insights from data.',
            'Designing efficient algorithms for problem-solving.',
            'Principles of software development and project management.',
            'Building dynamic websites and web applications.',
            'Developing applications for mobile devices.',
            'Managing and querying databases effectively.',
            'Utilizing cloud services for scalable applications.',
            'Protecting systems against cyber threats.',
            'Decentralized technology for secure transactions.',
            'Connecting devices to the internet for data exchange.',
            'Analyzing large datasets to uncover patterns.',
            'Integrating development and operations for efficiency.',
            'Designing user-friendly interfaces and experiences.',
            'Exploring the future of computing with quantum mechanics.'
        ];

        foreach ($tags as $index => $tagName) {
            Tag::create([
                'name' => $tagName,
                'description' => $descriptions[$index],
            ]);
        }
    }
}
