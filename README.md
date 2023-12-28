
## Prerequisites

- PHP ^8.1
- Composer
- MySQL
- npm

## Installation

1. Clone this repository: `git clone https://github.com/atilganajan/blog`

2. Navigate to the project folder: `cd blog`

3. Install composer dependencies: `composer install`

4. `php artisan serve`

5. `npm run dev`

6. Copy the `.env.example` file to `.env` and configure your database settings.

7.  `.env` mail configuration (Not:If the host is gmail, the app password is required) (https://support.google.com/mail/answer/185833?hl=en)

8. Generate the application key: `php artisan key:generate`

9. Run database migrations: `php artisan migrate`

10. Start the development server: `php artisan db:seed`
   
11. `php artisan queue:work`

