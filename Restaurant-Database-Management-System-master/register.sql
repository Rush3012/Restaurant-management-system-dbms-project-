

-- Create database if it does not exist
CREATE DATABASE IF NOT EXISTS food;
USE food;

-- Table for storing customer information
CREATE TABLE IF NOT EXISTS customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing menu items
CREATE TABLE IF NOT EXISTS menu (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    available BOOLEAN DEFAULT TRUE
);

-- Table for storing employee information
CREATE TABLE IF NOT EXISTS Employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50),
    salary DECIMAL(10, 2),
    hire_date DATE
);

-- Table for storing orders
CREATE TABLE IF NOT EXISTS Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);

-- Table for storing order items (mapping between orders and menu items)
CREATE TABLE IF NOT EXISTS OrderItems (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Menu(item_id) ON DELETE CASCADE
);

-- Table for storing employee roles (optional)
CREATE TABLE IF NOT EXISTS EmployeeRoles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

-- Table for assigning roles to employees (optional many-to-many relationship)
CREATE TABLE IF NOT EXISTS EmployeeRoleAssignments (
    assignment_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
    FOREIGN KEY (role_id) REFERENCES EmployeeRoles(role_id)
);

-- Insert sample data into Menu
INSERT INTO Menu (name, description, price, available) VALUES
('Burger', 'A delicious beef burger', 5.99, TRUE),
('Pizza', 'Cheese and tomato pizza', 7.99, TRUE),
('Salad', 'Fresh mixed salad', 4.50, TRUE);

-- Insert sample data into Employees
INSERT INTO Employees (name, position, salary, hire_date) VALUES
('John Doe', 'Manager', 55000.00, '2022-01-10'),
('Jane Smith', 'Chef', 40000.00, '2022-03-15'),
('Alice Johnson', 'Server', 25000.00, '2022-06-20');
