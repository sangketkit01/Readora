# Readora

**Readora** is a web application developed using Laravel as part of the Web Application Programming course project. It provides a comprehensive platform for users to **read and write novels or comics**, featuring a user-friendly design and robust functionality.

---

## 🌟 Key Features

### For Users:
- **Content Creation**: Create novels or comics with support for multiple chapters.
- **Full Content Management**: Add, edit, delete, and recover deleted items.
- **Privacy Control**: Set content visibility to private or public.
- **User Profiles**: Personalize your profile for a better experience.
- **Engagement**:
  - Comment on novels/comics.
  - Report inappropriate content.
- **Content Discovery**:
  - Get recommendations for trending novels or comics.
  - Search content by category.

### For Administrators:
- **User Management**:
  - Delete user accounts.
  - Block or remove inappropriate novels/comics.
- **Report Handling**:
  - Review and evaluate reports submitted by users.
- **Action Reversal**: Restore deleted accounts or content if needed.

---

## 🎯 Purpose

Readora is designed to empower both **content creators** and **administrators** by providing all necessary tools within a single platform. It offers a seamless experience for creating, managing, and exploring novels or comics while maintaining a safe and organized community.

---

## 🛠️ Technology Stack
- **Framework**: Laravel
- **Language**: PHP
- **Database**: MySQL / PostgreSQL (configurable)
- **Frontend**: Blade templates with optional integration for modern frontend frameworks.

---

## 🚀 Getting Started

### Prerequisites
Ensure you have the following installed on your machine:
- PHP (>=8.1)
- Composer
- MySQL or PostgreSQL
- A web server (e.g., Apache, Nginx)

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repository/readora.git
   ```

2. Navigate to the project directory:
   ```bash
   cd readora
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Configure the environment:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database and application settings.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

---

Enjoy exploring and creating with **Readora**! 🎉