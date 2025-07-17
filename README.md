# 🏥 Habibi Hospital Management System

**Habibi Hospital Management System** is a web-based application built using PHP and the CodeIgniter framework. It provides a centralized platform to efficiently manage a hospital’s operations, including appointments, patient records, billing, pharmacy, ward management, and user access control.

The system is designed with multiple user roles to facilitate the workflow of medical professionals and administrative staff alike.

---

## 🚀 Features

### 👥 User Roles

- **Admin**: Full access to manage users, settings, departments, and overall system controls.
- **Doctor**: View and manage appointments, access patient records, and update medical details.
- **Patient**: Book appointments, view prescriptions, invoices, and medical history.
- **Accountant**: Handle billing, payments, and financial records.
- **Nurse**: Manage ward information and assist with patient records.
- **Receptionist**: Schedule appointments and manage front-desk activities.
- **Pharmacist**: Manage medicine inventory and issue prescriptions.

---

## 🛠️ Tech Stack

- **Backend**: PHP (CodeIgniter Framework)
- **Frontend**: HTML, CSS, Bootstrap, JavaScript
- **Database**: MySQL

---

## 📦 Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/habibi-hms.git
   cd habibi-hms
   ```

````

2. **Create a Database**:

   * Create a new MySQL database (e.g., `habibi_hospital`).
   * Import the SQL schema (`Habibi-HMS.sql` file provided in the project).

3. **Configure Database**:

   * Open `application/config/database.php`
   * Update the following:

     ```php
     $db['default'] = array(
         'hostname' => 'localhost',
         'username' => 'your_db_username',
         'password' => 'your_db_password',
         'database' => 'habibi_hospital',
         ...
     );
     ```

4. **Run the Application**:

   * Place the project in your local server directory (e.g., `htdocs` for XAMPP).
   * Open in browser: `http://localhost/habibi-hms`

---

## 🔐 Demo Logins

> Use the following sample logins to access each role:

| Role         | Email                                                     | Password     |
| ------------ | --------------------------------------------------------- | ------------ |
| Admin        | [admin@domain.com](mailto:admin@domain.com)               | admin        |
| Doctor       | [doctor@domain.com](mailto:doctor@domain.com)             | doctor       |
| Patient      | [patient@domain.com](mailto:patient@domain.com)           | patient      |
| Accountant   | [accountant@domain.com](mailto:accountant@domain.com)     | accountant   |
| Nurse        | [nurse@domain.com](mailto:nurse@domain.com)               | nurse        |
| Receptionist | [receptionist@domain.com](mailto:receptionist@domain.com) | receptionist |
| Pharmacist   | [pharmacist@domain.com](mailto:pharmacist@domain.com)     | pharmacist   |

---

## ⚠️ Notes

* This project is currently in **private development** and not accepting public contributions.
* You can’t host a live PHP application *directly* using GitHub (it only serves static content). To host it online, consider using platforms like:

---

## 📄 License

This project does **not** currently have an open-source license applied. If you plan to make it public, consider adding a license like [MIT](https://choosealicense.com/licenses/mit/) or [GPLv3](https://choosealicense.com/licenses/gpl-3.0/).

---

## 🙌 Acknowledgments

Thanks to open-source tools like **CodeIgniter** and **Bootstrap**, this system was built to help streamline hospital operations and improve healthcare management.

---

```

---

Let me know if you want me to generate the `SQL` structure template, `.gitignore`, or a sample `config/database.php` as well.

Also, if you ever decide to make it public or want to prepare for deployment, I can help with that too.
```
````
