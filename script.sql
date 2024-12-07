CREATE TABLE categories (
    id INTEGER PRIMARY KEY;
    name VARCHAR(255) NOT NULL
)


CREATE TABLE products (
    id INTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO categories (id,name) VALUES
(1,"fruit"),
(2,"bostan"),
(3,"kumlla"),
(1,"patellgjan");


INSERT INSERT products (id,category_id) VALUES
(1,"Pjeshka",1),
(2,"bananet",1),
(3,"Buka",);