# Client Management System

This is a simple Client Management System built using Laravel, Bootstrap, and jQuery. It allows users to create, read, update, and delete (CRUD) clients, including uploading and managing images.

## Features

- Create a new client with first name, last name, and image.
- View a list of clients with their information.
- Update client information using a modal form.
- Delete clients with a confirmation alert using SweetAlert2.
- Image upload and preview functionality.

## Technologies Used

- **Laravel**: PHP framework for handling server-side logic and database interactions.
- **Bootstrap**: Frontend framework for styling and responsive design.
- **jQuery**: JavaScript library for handling DOM manipulations and AJAX requests.
- **SweetAlert2**: JavaScript library for creating beautiful alerts.

## Installation

Follow these steps to get the project up and running on your local machine.

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Emirhancapci/laravel-jquery-ajax.git
   cd laravel-jquery-ajax

### 2. Install Dependencies
Run the following commands to install the necessary PHP and JavaScript dependencies for the Laravel project:

```bash
composer install
npm install
npm run dev
```

### 3. Set Up Your .env File
Copy the example .env file to create your environment configuration file:

```bash
cp .env.example .env
```


### 4. Generate Application Key
Laravel requires an application key for encryption. Generate this key by running the following command:

```bash
php artisan key:generate
```

### 5. Run Migrations
To create the necessary database tables, run the Laravel migration command:

```bash
php artisan migrate
```

### 6. Run the Application
Start the development server by running:

```bash
php artisan serve
```

### Project Screenshots

Below are some screenshots showcasing the functionality and user interface of the project.

<img src="https://github.com/user-attachments/assets/ddd89c28-2b4e-4a31-acb6-e90a78d90012" alt="image" width="400">

<img src="https://github.com/user-attachments/assets/641a2c44-2799-412c-9cef-e92c36efb810" alt="image" width="400">

<img src="https://github.com/user-attachments/assets/f81af224-e2a7-4a17-896d-a4e05d68b8e3" alt="image" width="400">

<img src="https://github.com/user-attachments/assets/c3c5fb60-31aa-4a14-b2e3-2b78d9e11259" alt="image" width="400">

