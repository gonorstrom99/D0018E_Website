create
    definer = root@localhost procedure create_order(IN p_user_id int)
BEGIN
    DECLARE v_order_id int unsigned DEFAULT 0;

    IF (EXISTS(SELECT * FROM shopping_cart WHERE Account_id = p_user_id)) THEN
        INSERT INTO orders (Account_id) VALUES (p_user_id);
        set v_order_id = last_insert_id();

        INSERT INTO order_content (Order_id, Product_id, Quantity, Price)
            SELECT
                v_order_id,
                shopping_cart.Product_id,
                shopping_cart.Quantity,
                product_table.price
            FROM shopping_cart
                JOIN product_table
                    ON shopping_cart.Product_id = product_table.id
            WHERE Account_Id = p_user_id;

        DELETE FROM shopping_cart WHERE Account_id = p_user_id;

    END IF;

end;

