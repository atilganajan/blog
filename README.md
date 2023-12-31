
## Prerequisites

- PHP ^8.1
- Composer
- MySQL
- npm

## Installation

1. Clone this repository: `git clone https://github.com/atilganajan/blog`

2. Navigate to the project folder: `cd blog`

3. Install composer dependencies: `composer install`

4. `npm install`

5. `php artisan serve`

6. `npm run dev`

7. Copy the `.env.example` file to `.env` and configure your database settings.

8.  `.env` mail configuration (Not:If the host is gmail, the app password is required) (https://support.google.com/mail/answer/185833?hl=en)

9.  Update Queue connection  `QUEUE_CONNECTION=sync` to `QUEUE_CONNECTION=database`  

10. Generate the application key: `php artisan key:generate`

11. Run database migrations: `php artisan migrate`

12. Start the development server: `php artisan db:seed`
   
13. `php artisan queue:work`

