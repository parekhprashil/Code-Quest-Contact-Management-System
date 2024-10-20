# Contact Management System

This Contact Management System is a simple database application designed to manage users and their associated contact details. It allows users to store, view, edit, and delete their contacts, with additional features for importing and exporting contacts in **VCF (vCard)** format. The system is built using two primary database tables:

1. **Users**: Contains information about registered users.
2. **Contacts**: Stores contact details for each user.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Usage](#usage)
  - [Basic Contact Management](#basic-contact-management)
  - [Importing Contacts from VCF](#importing-contacts-from-vcf)
  - [Exporting Contacts to VCF](#exporting-contacts-to-vcf)
- [Sample Data](#sample-data)
- [License](#license)

---

## Prerequisites

To set up the Contact Management System, you will need the following:

- A local or remote MySQL/MariaDB server or any other SQL-compatible database.
- Basic knowledge of SQL to interact with the database.
- A programming environment (such as PHP, Python, Node.js, etc.) to integrate with the database.
- A library or tool to handle **VCF (vCard)** format for importing/exporting contacts.

## Database Schema

### 1. **Users Table**

The `Users` table stores the essential information for each user of the system.

| Column    | Data Type | Description                                  |
| --------- | --------- | -------------------------------------------- |
| id        | INT       | Primary key, auto-incremented unique user ID |
| username  | VARCHAR   | Username of the user                         |
| emailid   | VARCHAR   | Email address of the user                    |
| password  | VARCHAR   | Password (hashed for security)               |

#### SQL Query to Create `Users` Table:
```sql
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    emailid VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

### 2. **Contacts Table**

The `Contacts` table stores the contact details for each user, with a foreign key linking each contact to the user.

| Column          | Data Type | Description                                       |
| --------------- | --------- | ------------------------------------------------- |
| id              | INT       | Primary key, auto-incremented unique contact ID   |
| contact_name    | VARCHAR   | Name of the contact                               |
| contact_phone   | VARCHAR   | Phone number of the contact                       |
| contact_email   | VARCHAR   | Email address of the contact                      |
| userid          | INT       | Foreign key referencing the `id` column in `Users`|

#### SQL Query to Create `Contacts` Table:
```sql
CREATE TABLE Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_name VARCHAR(100) NOT NULL,
    contact_phone VARCHAR(15) NOT NULL,
    contact_email VARCHAR(100),
    userid INT,
    FOREIGN KEY (userid) REFERENCES Users(id) ON DELETE CASCADE
);
```

---

## Installation

### 1. Set up the Database

1. Connect to your database server (MySQL/MariaDB).
2. Create a new database:

```sql
CREATE DATABASE contact_management;
USE contact_management;
```

3. Run the provided SQL queries to create the `Users` and `Contacts` tables.

### 2. Sample Data Insertion

Use the following SQL queries to insert sample data into the `Users` and `Contacts` tables.

#### Insert Sample Data into `Users` Table:

```sql
INSERT INTO Users (username, emailid, password)
VALUES
('john_doe', 'john@example.com', 'hashed_password_1'),
('jane_smith', 'jane@example.com', 'hashed_password_2');
```

#### Insert Sample Data into `Contacts` Table:

```sql
INSERT INTO Contacts (contact_name, contact_phone, contact_email, userid)
VALUES
('Alice', '555-1234', 'alice@example.com', 1),
('Bob', '555-5678', 'bob@example.com', 1),
('Charlie', '555-9876', 'charlie@example.com', 2);
```

---

## Usage

### Basic Contact Management

1. **Adding a New User**: Add a new user by inserting data into the `Users` table.
2. **Adding a New Contact**: Add a new contact linked to a specific user by inserting data into the `Contacts` table using the `userid`.
3. **Viewing Contacts**: View contacts for a specific user by joining the `Users` and `Contacts` tables.
4. **Editing Contacts**: Update contact details by modifying data in the `Contacts` table.
5. **Deleting Contacts**: Remove a contact by deleting the record from the `Contacts` table. Contacts will be automatically removed if a user is deleted (due to the foreign key constraint).

### Importing Contacts from VCF

The system supports importing contacts from a **VCF (vCard)** file. Each user can import their contacts in bulk via a VCF file.

#### Steps for Importing VCF:

1. Parse the VCF file using a programming language (e.g., Python with `vobject` or PHP with `Contact_VCard_Build`).
2. For each contact in the VCF file:
   - Extract details such as `name`, `phone number`, and `email`.
   - Insert the contact into the `Contacts` table using the corresponding `userid`.


### Exporting Contacts to VCF

The system also allows exporting user contacts to a **VCF (vCard)** file format.

#### Steps for Exporting Contacts to VCF:

1. Retrieve contacts from the `Contacts` table for a specific user.
2. Format the retrieved contacts as a VCF.
3. Write the VCF file for the user to download or store.

## Sample Data

### Users Table

| id  | username   | emailid            | password           |
| --- | ---------- | ------------------ | ------------------ |
| 1   | john_doe   | john@example.com    | hashed_password_1  |
| 2   | jane_smith | jane@example.com    | hashed_password_2  |

### Contacts Table

| id  | contact_name | contact_phone | contact_email     | userid |
| --- | ------------ | ------------- | ----------------- | ------ |
| 1   | Alice        | 555-1234      | alice@example.com | 1      |
| 2   | Bob          | 555-5678      | bob@example.com   | 1      |
| 3   | Charlie      | 555-9876      | charlie@example.com | 2      |

---

## License

This project is licensed under the MIT License. You are free to use, modify, and distribute this system as per the terms of the license.

--- 

Happy coding!
