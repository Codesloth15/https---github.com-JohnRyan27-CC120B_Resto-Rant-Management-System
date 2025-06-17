# 📦 Database Schema Documentation

This documentation outlines the structure of the database including SQL `CREATE TABLE` statements for each table used in the system.

---

## 🏨 Table: `rooms`

### SQL

```sql
CREATE TABLE rooms (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    room_type VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    price DECIMAL(10,2),
    image_path VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    props TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    PRIMARY KEY (id)
);
```

### Description

Stores information about rooms available for booking or listing.

| Column       | Type            | Description                              |
|--------------|------------------|------------------------------------------|
| `id`         | INT(11)          | Primary Key, Auto Increment              |
| `name`       | VARCHAR(100)     | Name of the room                         |
| `description`| TEXT             | Optional room description                |
| `room_type`  | VARCHAR(20)      | Room type (e.g., single, deluxe)         |
| `price`      | DECIMAL(10,2)    | Room price                               |
| `image_path` | VARCHAR(255)     | Path to room image                       |
| `created_at` | TIMESTAMP        | Auto-generated timestamp on creation     |
| `props`      | TEXT             | Extra room features (JSON/text)          |

---

## 🍽️ Table: `items`

### SQL

```sql
CREATE TABLE items (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    category ENUM('Meal', 'Drink', 'Snack', 'Dessert', 'Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    photo VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    PRIMARY KEY (id)
);
```

### Description

Stores menu items or inventory entries like meals, snacks, and beverages.

| Column       | Type                                           | Description                     |
|--------------|------------------------------------------------|---------------------------------|
| `id`         | INT(11)                                        | Primary Key, Auto Increment     |
| `name`       | VARCHAR(255)                                   | Item name                       |
| `description`| TEXT                                           | Optional item description       |
| `category`   | ENUM('Meal', 'Drink', 'Snack', 'Dessert', 'Other') | Category of item            |
| `price`      | DECIMAL(10,2)                                  | Item price                      |
| `image_path` | VARCHAR(255)                                   | Path to item image              |
| `created_at` | TIMESTAMP                                      | Time of creation                |
| `photo`      | VARCHAR(255)                                   | Alternate/additional image      |

---

## 👤 Table: `users`

### SQL

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    email VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    phone VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    address VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    username VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    password TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    role TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id),
    INDEX (username)
);
```

### Description

Stores user account data.

| Column     | Type          | Description                                 |
|------------|----------------|---------------------------------------------|
| `id`       | INT(11)        | Primary Key, Auto Increment                 |
| `name`     | VARCHAR(100)   | Full name                                   |
| `email`    | VARCHAR(100)   | User email                                  |
| `phone`    | VARCHAR(20)    | Contact number                              |
| `address`  | VARCHAR(255)   | User's address                              |
| `username` | VARCHAR(50)    | Login username (indexed)                    |
| `password` | TEXT           | Hashed user password                        |
| `role`     | TEXT           | User role (e.g., admin, user) - NOT NULL    |

---

## 🛡 Notes

- All tables use `utf8mb4` character set and `utf8mb4_general_ci` collation.
- Primary keys are `AUTO_INCREMENT`.
- `created_at` fields default to the current time (`CURRENT_TIMESTAMP`).
- Indexes are used for `username` to optimize authentication performance.

---

## 🔐 Recommendations

- Use strong hashing (e.g., bcrypt) for passwords.
- Sanitize user input to prevent SQL injection and XSS.
- Consider adding `UNIQUE` constraints to `username` and `email` fields.

---

## 🛠 Future Enhancements

- Add `FOREIGN KEY` constraints between users and other related data.
- Include `updated_at` and `deleted_at` fields for better record management.
- Normalize repeated information across tables where applicable.