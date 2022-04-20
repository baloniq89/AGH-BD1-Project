-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2022-02-10 00:42:45.56

-- foreign keys
ALTER TABLE restauracja.znizki
    DROP CONSTRAINT Discounts_Customers;

ALTER TABLE restauracja.szczegolyZamowienia
    DROP CONSTRAINT OrderDetails_Menu;

ALTER TABLE restauracja.szczegolyZamowienia
    DROP CONSTRAINT OrderDetails_Orders;

ALTER TABLE restauracja.zamowienia
    DROP CONSTRAINT Orders_Customers;

ALTER TABLE restauracja.rezerwacja
    DROP CONSTRAINT Reservation_Orders;

ALTER TABLE restauracja.stolik_rezerwacja
    DROP CONSTRAINT TableRes_Reservation;

ALTER TABLE restauracja.menu
    DROP CONSTRAINT menu_kategorie;

ALTER TABLE restauracja.stolik_rezerwacja
    DROP CONSTRAINT stolik_rezerwacja_stolik;

ALTER TABLE restauracja.zamowienia
    DROP CONSTRAINT zamowienia_typZamowienia;

-- tables
DROP TABLE restauracja.kategorie;

DROP TABLE restauracja.klienci;

DROP TABLE restauracja.menu;

DROP TABLE restauracja.rezerwacja;

DROP TABLE restauracja.stolik;

DROP TABLE restauracja.stolik_rezerwacja;

DROP TABLE restauracja.szczegolyZamowienia;

DROP TABLE restauracja.typZamowienia;

DROP TABLE restauracja.zamowienia;

DROP TABLE restauracja.znizki;

-- End of file.

