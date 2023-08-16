<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://img.shields.io/badge/license-MIT-blue.svg">
</head>
<body>
  <h1>Simple Task Management </h1>
  
  <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License">

  <p>The Task Management System is a web application built using Laravel 10 and Vue.js 3 that provides a comprehensive solution for managing tasks. This system follows the principles of the Repository pattern, SOLID principles, and DRY (Don't Repeat Yourself) methodology to ensure a clean and maintainable codebase.</p>

  <h2>Getting Started</h2>
  
  <h3>Backend Prerequisites</h3>
<p>Before setting up the backend of the Task Management System, make sure you have the following components installed:</p>
<ul>
  <li>PHP 8.2.4</li>
  <li>Composer 2.5.7</li>
  <li>Apache 2.4.56</li>
  <li>MariaDB 5.4.28</li>
  <li>you can use New XAMPP(8.2.4) for PHP, Apache and MariaDB</li>
</ul>

<h4>Framework and Packages</h4>
<p>The backend of the Task Management System utilizes the Laravel framework for building robust and scalable applications. Additionally, the following versions of Laravel and Laravel Passport are used:</p>
<ul>
  <li>Laravel 10.10</li>
  <li>Laravel Passport 11.8</li>
</ul>
  
  <h3>Frontend Prerequisites</h3>
<p>To work with the frontend of the Task Management System, ensure you have the following components installed:</p>
<ul>
  <li>Node.js 18.17.0</li>
  <li>npm 9.6.7</li>
  <li>Vue.js 3</li>
</ul>

<h4>Framework and Packages</h4>
<p>The frontend of the Task Management System utilizes the Vue.js framework (version 3) and the following packages:</p>
<ul>
  <li>axios 1.4.0</li>
  <li>js-cookie 3.0.5</li>
  <li>pinia 2.1.6</li>
  <li>vue 3.3.4</li>
  <li>vue-router 4.2.4</li>
</ul>
  
  <h2>Installation</h2>
<p>You can clone the Task Management System repository from GitHub using the following command:</p>
<pre><code>git clone https://github.com/bdraihan71/FITL-task-management.git</code></pre>
<p>After cloning, navigate to the project directory:</p>
<pre><code>cd FITL-task-management</code></pre>

<h2>Backend Installation</h2>

<ol start="1">
  <li>Make sure you are on the main branch:</li>
</ol>
<pre><code>git checkout main</code></pre>
<ol start="2">
  <li>Navigate to the backend directory:</li>
</ol>
<pre><code>cd backend</code></pre>
<ol start="3">
  <li>Install the required PHP dependencies:</li>
</ol>
<pre><code>composer install</code></pre>
<ol start="4">
  <li>Create a copy of the `.env` file:</li>
</ol>
<pre><code>cp .env.example .env</code></pre>
<ol start="5">
  <li>Generate the application key:</li>
</ol>
<pre><code>php artisan key:generate</code></pre>
<ol start="6">
  <li>Edit the `.env` file to set up the database and mail settings:</li>
</ol>
<pre><code>DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your_mail@example.com
MAIL_FROM_NAME="${APP_NAME}"</code></pre>
<ol start="7">
  <li>Configure mail settings by obtaining credentials from <a href="https://mailtrap.io" target="_blank">Mailtrap.io</a></li>
</ol>
<ol start="8">
  <li>Run database migrations:</li>
</ol>
<pre><code>php artisan migrate</code></pre>
<ol start="9">
  <li>Install Laravel Passport:</li>
</ol>
<pre><code>php artisan passport:install</code></pre>
<ol start="10">
  <li>Start the backend server on port 8000:</li>
</ol>
<pre><code>php artisan serve --port=8000</code></pre>
<ol start="11">
  <li>Start the queue worker for background tasks:</li>
</ol>
<pre><code>php artisan queue:work</code></pre>

<h2>Frontend Installation</h2>
<ol>
  <li>Make sure you are on the main branch:</li>
</ol>
<pre><code>git checkout main</code></pre>
<ol start="2">
  <li>Navigate to the frontend directory:</li>
</ol>
<pre><code>cd frontend</code></pre>
<ol start="3">
  <li>Install the required Node.js dependencies:</li>
</ol>
<pre><code>npm install</code></pre>
<ol start="4">
  <li>Run the frontend development server:</li>
</ol>
<pre><code>npm run dev</code></pre>

<h2>Usage</h2>
<p>The Task Management System simplifies task tracking and collaboration. Users can:</p>
<ul>
   <li>Login to access their account</li>
  <li>Sign up to create a new account</li>
  <li>Create, update, and delete tasks</li>
  <li>Assign tasks to team members</li>
  <li>Set Dadeline</li>
  <li>View tasks in a user-friendly dashboard</li>
</ul>
<p>Additionally, the system sends email notifications when a task is assigned to a user.</p>

  
  <h2>License</h2>
  <p>This project is licensed under the MIT License - see the <a href="LICENSE">LICENSE</a> file for details.</p>

  

</body>
</html>
