CREATE TABLE categories (
    id INTEGER PRIMARY KEY,
    name VARCHAR (250) NOT NULL
);

CREATE TABLE products (
    id INTEGER PRIMARY KEY,
    name VARCHAR (250) NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) 

);

INSERT INTO categories (id,name) VALUES 
(1,"EKO FRUIT"),
(2,"Bakery"),
(3,"Dry Goods"),
(4,"Vegetables");

INSERT INTO products (id,name,category_id) VALUES
(1,"Waild Fruits",1),
(2,"Sour Cherry",1),
(3, "Bread",2);
