CREATE TABLE catagories (
    id INTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

    CREATE TABLE produtcs (
        id INTEGER PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        category_id INTEGER NOT NULL
        FOREIGN KEY (category_id) REFERENCES categories(id)

);

INSERT INTO  catagories(id,name) VALUES
(1, "Fruit"),
(2, "Bakery"),
(3, "Dry goods"),
(4, "Vegetables");


INSERT INTO products (id,name,category_id) VALUES
(1,"Appels",1),
(2,"Banana",1),
(3,"Grapes",2);


