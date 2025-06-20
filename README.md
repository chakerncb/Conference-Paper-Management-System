# Conference Paper Management System

 ### AcademIQ (Academic Inteligent Quotient).
A comprehensive system for managing academic conference paper submissions, reviews, and decisions built with Laravel, Livewire, and Tailwind CSS.

## Table of Contents

- [Overview](#overview)
- [System Requirements](#system-requirements)
- [Setup Instructions](#setup-instructions)
- [User Roles and Functionality](#user-roles-and-functionality)
  - [Chair (Admin)](#chair-admin)
  - [Reviewer](#reviewer)
  - [Author](#author)
- [System Features](#system-features)
- [Technical Implementation](#technical-implementation)

## Overview

The Conference Paper Management System streamlines the entire academic conference workflow, from paper submissions to final decisions. It supports blind review processes, multiple reviewer assignments, and comprehensive conference management settings.

## System Requirements

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Laravel 12.x
- MySQL/SQLite database

## Setup Instructions

1. **Clone the repository**

   ```bash
   git clone https://github.com/chakerncb/Conference-Paper-Management-System.git
   cd Conference-Paper-Management-System
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Setup environment variables**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   
   Edit the `.env` file with your database credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=conference_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   
   For SQLite (included in project):

   ```env
   DB_CONNECTION=sqlite
   # Comment out other DB_* variables
   ```

5. **Configure mail settings**
   
   Edit the `.env` file with your mail server details:

   - In this example, I use MailHog for local development. Make sure to have it running.

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=localhost
   MAIL_PORT=1025
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="noreply@conference.org"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

6. **Run migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```

7. **Create storage link**

   ```bash
   php artisan storage:link
   ```

8. **Install frontend dependencies**

   ```bash
   npm install
   npm run dev
   ```

9. **Start the development server**

   ```bash
   php artisan serve
   ```

   - go to `http://localhost:8000` in your browser.
   
   - to login use the following credentials:
     - **Chair (Admin)**: 
       - Email: `chair@gmail.com`
       - Password: `11111111`

10. **Access the application**
    Visit `http://localhost:8000` in your browser.

## User Roles and Functionality

### Chair (Admin)

 #### route: `/chair`

The Chair serves as the system administrator with comprehensive control over the conference management process.

**Responsibilities and Features:**

- **Dashboard**: Access to conference statistics and overview
- **Papers Management**:
  - View all submitted papers
  - Assign reviewers to papers
  - Make final acceptance/rejection decisions
  - Send decision notifications to authors
- **Users Management**:
  - Create and manage user accounts
  - Assign roles (chair, reviewer, author)
- **Conference Settings**:
  - Configure conference details (name, location, year, etc.)
  - Set important deadlines (submission, review, camera-ready)
  - Define review process settings (reviews per paper, blind review)
  - Configure paper submission guidelines and review criteria

### Reviewer

#### route: `/reviewer`

Reviewers evaluate assigned papers according to the conference's review criteria.

**Responsibilities and Features:**

- **Dashboard**: View assigned papers and review deadlines
- **Review Management**:
  - Access assigned papers for review
  - Submit scores and comments
  - Track review status (pending vs. completed)
  - View review history
- **Review Process**:
  - Blind review process (when enabled by chair)
  - Score papers according to defined criteria
  - Submit detailed comments and recommendations

### Author

#### route: `/home`

Authors submit papers for review and track their status throughout the conference process.

**Responsibilities and Features:**

- **Dashboard**: Track paper submission status
- **Paper Submission**:
  - Submit new papers (title, abstract, keywords, PDF file)
  - Accept submission agreements (template compliance, originality, etc.)
  - Track submission status (submitted, under review, accepted, rejected)
- **Paper Management**:
  - View submitted papers and their current status
  - Receive decision notifications
  - Submit camera-ready versions (for accepted papers)

## System Features

- **Blind Review Process**: Supports anonymous review to ensure unbiased evaluation
- **Multiple Reviewer Assignment**: Each paper can be assigned to multiple reviewers (configurable)
- **Comprehensive Settings**: Fully configurable conference settings
- **Deadline Management**: Automatic enforcement of submission and review deadlines
- **File Management**: Secure storage and access control for paper uploads
- **Email Notifications**: Automated emails for important events and decisions
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Real-time Updates**: Livewire for dynamic updates without page reloads

## Technical Implementation

- **Backend**: Laravel 12.x PHP Framework
- **Frontend**: Livewire 3.x with Tailwind CSS
- **Database**: Migration-based schema with seeders for initial data
- **Authentication**: Laravel's built-in authentication
- **File Storage**: Laravel's filesystem for secure paper storage
- **Real-time UI Updates**: Livewire for dynamic, reactive interfaces
- **Middleware**: Role-based access control for different user types

## Owner 
@chakerncb 
