নিচে আপনার StockGenie project-এর জন্য পুরো **database table dependency \+ migration order** একটি Markdown document আকারে দিলাম।

````
# StockGenie — Database Migration Order & Table Dependency

## 1. মূল নিয়ম

Laravel migration তৈরি করার সময় একটি গুরুত্বপূর্ণ নিয়ম:

> যে table-কে অন্য table-এর Foreign Key reference করে, সেই parent table অবশ্যই আগে তৈরি হতে হবে।

উদাহরণ:

```text
categories
     ↓
products
````

 কারণ `products.category_id` → `categories.id` reference করে।

 তাই `categories` আগে এবং `products` পরে তৈরি করতে হবে।

---

 # 2\. Recommended Migration Order

 StockGenie-এর বর্তমান table অনুযায়ী recommended order:

```
1. users
2. categories
3. suppliers
4. customers
5. warehouses
6. departments
7. positions
8. employees
9. products
10. purchases
11. purchase_items
12. product_stocks
13. stock_ledgers
14. sales
15. sales_items
16. sale_returns
17. payments
18. activity_logs
```

---

 # 3\. Dependency Diagram

```
users
  │
  ├──────────────→ activity_logs
  │
  └──────────────→ stock_ledgers

categories ─────────→ products
                       │
suppliers ────────────→│
                       │
warehouses ───────────→│
                       ↓
                  product_stocks
                       │
                       ↓
                  stock_ledgers

suppliers ───────→ purchases
                      │
products ────────────→│
                      ↓
                 purchase_items
                      │
                      ↓
                product_stocks

customers ───────→ sales
                     │
products ──────────→│
                     ↓
                 sales_items
                     │
                     ↓
                sale_returns

sales ───────────→ payments
```

---

 # 4\. Basic Table Relationship

 ## Users

```
users
```

 System users/adminদের information রাখবে।

 অন্যান্য table-এর `created_by`, `updated_by`, `user_id` ইত্যাদি থাকলে `users` আগে তৈরি করতে হবে।

---

 # 5\. Categories

```
categories
```

 Product-এর category রাখবে।

 Relationship:

```
categories
     │
     └──────→ products
```

 Product table:

```
products.category_id
        ↓
categories.id
```

 তাই:

```
categories
```

 অবশ্যই:

```
products
```

 এর আগে তৈরি হবে।

---

 # 6\. Suppliers

```
suppliers
```

 Product এবং Purchase-এর supplier information রাখবে।

 Relationship:

```
suppliers
    │
    ├──────→ products
    │
    └──────→ purchases
```

 তাই `suppliers` আগে তৈরি হবে।

---

 # 7\. Customers

```
customers
```

 Customer information রাখবে।

 Relationship:

```
customers
    │
    └──────→ sales
```

 তাই `customers` আগে এবং `sales` পরে।

---

 # 8\. Warehouses

```
warehouses
```

 কোন warehouse-এ stock থাকবে সেটা manage করবে।

 Relationship:

```
warehouses
     │
     └──────→ product_stocks
```

 তাই `warehouses` আগে তৈরি হবে।

---

 # 9\. Departments

```
departments
```

 Employee-এর department information রাখবে।

 যদি:

```
employees.department_id
        ↓
departments.id
```

 হয়, তাহলে:

```
departments
     ↓
employees
```

---

 # 10\. Positions

```
positions
```

 Employee-এর job position/designation রাখবে।

 যদি:

```
employees.position_id
        ↓
positions.id
```

 হয়, তাহলে:

```
positions
     ↓
employees
```

---

 # 11\. Employees

```
employees
```

 Employee information রাখবে।

 যদি employees table-এর মধ্যে থাকে:

```
department_id
position_id
```

 তাহলে আগে তৈরি হতে হবে:

```
departments
positions
```

 তারপর:

```
employees
```

---

 # 12\. Products

```
products
```

 Product-এর মূল information রাখবে।

 Products সাধারণত reference করবে:

```
products
   │
   ├── category_id → categories.id
   ├── supplier_id → suppliers.id
   └── warehouse_id → warehouses.id
```

 তাই:

```
categories
suppliers
warehouses
       ↓
    products
```

---

 # 13\. Purchases

```
purchases
```

 Supplier থেকে product purchase করার main transaction।

 Relationship:

```
suppliers
    ↓
purchases
```

 যদি purchase-এ employee/user থাকে:

```
users
    ↓
purchases
```

 তাই purchases পরে তৈরি হবে।

---

 # 14\. Purchase Items

```
purchase_items
```

 একটি purchase-এর মধ্যে কোন কোন product আছে সেটা রাখবে।

 Relationship:

```
purchases
     │
     └──────→ purchase_items

products
     │
     └──────→ purchase_items
```

 তাই:

```
purchases
products
    ↓
purchase_items
```

---

 # 15\. Product Stocks

```
product_stocks
```

 কোন product কোন warehouse-এ কত quantity আছে সেটা রাখবে।

 Relationship:

```
products
    │
    └──────→ product_stocks

warehouses
    │
    └──────→ product_stocks
```

 তাই:

```
products
warehouses
    ↓
product_stocks
```

---

 # 16\. Stock Ledgers

```
stock_ledgers
```

 Stock-এর movement/history রাখবে।

 যেমন:

```
Purchase +100
Sale     -20
Return   +5
Adjustment -2
```

 Relationship হতে পারে:

```
products
    ↓
stock_ledgers

warehouses
    ↓
stock_ledgers

users
    ↓
stock_ledgers
```

 তাই আগে:

```
products
warehouses
users
```

 তারপর:

```
stock_ledgers
```

---

 # 17\. Sales

```
sales
```

 Customer-এর sales transaction-এর main information রাখবে।

 Relationship:

```
customers
    ↓
sales
```

 এছাড়াও user/employee থাকলে:

```
users
    ↓
sales
```

---

 # 18\. Sales Items

```
sales_items
```

 একটি sale-এর মধ্যে কোন কোন product বিক্রি হয়েছে সেটা রাখবে।

 Relationship:

```
sales
   │
   └──────→ sales_items

products
   │
   └──────→ sales_items
```

 তাই:

```
sales
products
   ↓
sales_items
```

---

 # 19\. Sale Returns

```
sale_returns
```

 Customer product ফেরত দিলে তার information রাখবে।

 সাধারণ relationship:

```
sales
   ↓
sale_returns

products
   ↓
sale_returns
```

 তাই আগে:

```
sales
products
```

 তারপর:

```
sale_returns
```

---

 # 20\. Payments

```
payments
```

 Customer payment বা transaction payment information রাখবে।

 যদি:

```
payments.sale_id
       ↓
sales.id
```

 হয়, তাহলে:

```
sales
  ↓
payments
```

---

 # 21\. Activity Logs

```
activity_logs
```

 User কী action করেছে তার history রাখবে।

 যেমন:

```
User created product
User updated product
User deleted product
User created sale
```

 যদি:

```
activity_logs.user_id
       ↓
users.id
```

 হয়, তাহলে:

```
users
  ↓
activity_logs
```

 তাই এটি শেষের দিকে তৈরি করা যায়।

---

 # 22\. Final Migration Structure

 Recommended migration sequence:

```
database/
└── migrations/

    0001_01_01_000000_create_users_table.php

    2026_02_10_000001_create_categories_table.php
    2026_02_10_000002_create_suppliers_table.php
    2026_02_10_000003_create_customers_table.php
    2026_02_10_000004_create_warehouses_table.php

    2026_02_10_000005_create_departments_table.php
    2026_02_10_000006_create_positions_table.php
    2026_02_10_000007_create_employees_table.php

    2026_02_10_000008_create_products_table.php

    2026_02_10_000009_create_purchases_table.php
    2026_02_10_000010_create_purchase_items_table.php

    2026_02_10_000011_create_product_stocks_table.php
    2026_02_10_000012_create_stock_ledgers_table.php

    2026_02_10_000013_create_sales_table.php
    2026_02_10_000014_create_sales_items_table.php
    2026_02_10_000015_create_sale_returns_table.php

    2026_02_10_000016_create_payments_table.php
    2026_02_10_000017_create_activity_logs_table.php
```

---

 # 23\. সবচেয়ে গুরুত্বপূর্ণ Dependency Chain

 ## Product

```
categories
      ↓
suppliers
      ↓
warehouses
      ↓
products
```

 ## Purchase

```
suppliers
      ↓
purchases
      ↓
purchase_items
      ↑
products
```

 ## Stock

```
products ──────┐
               ├──→ product_stocks
warehouses ────┘

products ──────┐
warehouses ────┼──→ stock_ledgers
users ─────────┘
```

 ## Sales

```
customers
    ↓
sales
    ↓
sales_items
    ↑
products
```

 ## Returns

```
sales
  ↓
sale_returns
  ↑
products
```

 ## Payments

```
sales
  ↓
payments
```

 ## Activity

```
users
  ↓
activity_logs
```

---

 # 24\. Foreign Key Rule

 যদি থাকে:

```
$table->foreignId('category_id')
    ->constrained('categories');
```

 তাহলে:

```
categories table
```

 আগে তৈরি হতে হবে।

 একইভাবে:

```
$table->foreignId('supplier_id')
    ->constrained('suppliers');
```

 হলে:

```
suppliers
    ↓
products
```

 এবং:

```
$table->foreignId('warehouse_id')
    ->constrained('warehouses');
```

 হলে:

```
warehouses
    ↓
products/product_stocks
```

---

 # 25\. nullable + nullOnDelete

 যদি লিখেন:

```
$table->foreignId('category_id')
    ->nullable()
    ->constrained('categories')
    ->nullOnDelete();
```

 এর অর্থ:

```
Category delete
      ↓
Product থাকবে
      ↓
product.category_id = NULL
```

 `nullable()` এখানে গুরুত্বপূর্ণ।

 কারণ `NULL` রাখতে হলে column nullable হতে হবে।

---

 # 26\. Migration Run

 সব migration নতুন করে চালাতে:

```
php artisan migrate:fresh
```

 Migration status দেখতে:

```
php artisan migrate:status
```

 Migration চালাতে:

```
php artisan migrate
```

 শেষ migration rollback:

```
php artisan migrate:rollback --step=1
```

---

 # 27\. আপনার বর্তমান Error-এর কারণ

 আপনার বর্তমান migration order ছিল:

```
products
   ↓
references
   ↓
categories
```

 কিন্তু সঠিক order:

```
categories
   ↓
products
```

 আপনার `categories` migration বর্তমানে:

```
2026_04_18_001017_create_categories_table.php
```

 আর `products`:

```
2026_02_10_000005_create_products_table.php
```

 তাই `products` আগে execute হচ্ছে।

 ফলে Laravel যখন execute করছে:

```
FOREIGN KEY (category_id)
REFERENCES categories(id)
```

 তখন `categories` table এখনো তৈরি হয়নি।

---

 # 28\. Final Rule

 Database migration order মনে রাখার সহজ নিয়ম:

```
PARENT TABLE
     ↓
CHILD TABLE
```

 উদাহরণ:

```
categories
     ↓
products
     ↓
purchase_items
     ↓
stock_ledgers
```

 আর:

```
customers
     ↓
sales
     ↓
sales_items
     ↓
sale_returns
```

 অর্থাৎ **যে table অন্য table-কে reference করে, সেটি পরে তৈরি হবে।**

```

```