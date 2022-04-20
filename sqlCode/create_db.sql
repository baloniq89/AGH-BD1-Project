-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2022-02-10 00:42:45.56

-- tables
-- Table: kategorie
CREATE TABLE restauracja.kategorie (
    kategoria_id int  NOT NULL,
    nazwa varchar(40)  NOT NULL,
    CONSTRAINT Categories_pk PRIMARY KEY (kategoria_id)
);

-- Table: klienci
CREATE TABLE restauracja.klienci (
    klient_id int  NOT NULL,
    imie varchar(30)  NULL,
    telefon varchar(15)  NOT NULL,
    email varchar(30)  NULL,
    CONSTRAINT Customers_pk PRIMARY KEY (klient_id)
);

-- Table: menu
CREATE TABLE restauracja.menu (
    pozycja_id int  NOT NULL,
    kategoria_id int  NOT NULL,
    nazwa_dania varchar(50)  NOT NULL,
    cena money  NOT NULL,
    CONSTRAINT Menu_pk PRIMARY KEY (pozycja_id)
);

-- Table: rezerwacja
CREATE TABLE restauracja.rezerwacja (
    rezerwacja_id int  NOT NULL,
    id_zamow int  NOT NULL,
    data date  NOT NULL,
    czas time  NOT NULL,
    CONSTRAINT Reservation_pk PRIMARY KEY (rezerwacja_id)
);

-- Table: stolik
CREATE TABLE restauracja.stolik (
    stolik_id int  NOT NULL,
    ilosc_osob int  NOT NULL,
    czy_vip boolean  NOT NULL,
    CONSTRAINT stolik_pk PRIMARY KEY (stolik_id)
);

-- Table: stolik_rezerwacja
CREATE TABLE restauracja.stolik_rezerwacja (
    stolik_rezerwacja_id int  NOT NULL,
    rezerwacja_rezerwacja_id int  NOT NULL,
    stolik_stolik_id int  NOT NULL,
    CONSTRAINT TableRes_pk PRIMARY KEY (stolik_rezerwacja_id)
);

-- Table: szczegolyZamowienia
CREATE TABLE restauracja.szczegolyZamowienia (
    zamowienie_id int  NOT NULL,
    pozycja_id int  NOT NULL,
    cena_pozycji money  NOT NULL,
    ilosc int  NOT NULL,
    CONSTRAINT OrderDetails_pk PRIMARY KEY (pozycja_id,zamowienie_id)
);

-- Table: typZamowienia
CREATE TABLE restauracja.typZamowienia (
    id_zamow int  NOT NULL,
    na_wynos boolean  NOT NULL,
    odbior date  NULL,
    CONSTRAINT OrderType_pk PRIMARY KEY (id_zamow)
);

-- Table: zamowienia
CREATE TABLE restauracja.zamowienia (
    zamowienie_id int  NOT NULL,
    klienci_klient_id int  NOT NULL,
    typZamowienia_id_zamow int  NOT NULL,
    CONSTRAINT Orders_pk PRIMARY KEY (zamowienie_id)
);

-- Table: znizki
CREATE TABLE restauracja.znizki (
    znizka_id int  NOT NULL,
    klient_id int  NOT NULL,
    start date  NOT NULL,
    wygasa date  NOT NULL,
    procent_znizka float  NOT NULL,
    CONSTRAINT Discounts_pk PRIMARY KEY (znizka_id)
);

-- foreign keys
-- Reference: Discounts_Customers (table: znizki)
ALTER TABLE restauracja.znizki ADD CONSTRAINT Discounts_Customers
    FOREIGN KEY (klient_id)
    REFERENCES restauracja.klienci (klient_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: OrderDetails_Menu (table: szczegolyZamowienia)
ALTER TABLE restauracja.szczegolyZamowienia ADD CONSTRAINT OrderDetails_Menu
    FOREIGN KEY (pozycja_id)
    REFERENCES restauracja.menu (pozycja_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: OrderDetails_Orders (table: szczegolyZamowienia)
ALTER TABLE restauracja.szczegolyZamowienia ADD CONSTRAINT OrderDetails_Orders
    FOREIGN KEY (zamowienie_id)
    REFERENCES restauracja.zamowienia (zamowienie_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Orders_Customers (table: zamowienia)
ALTER TABLE restauracja.zamowienia ADD CONSTRAINT Orders_Customers
    FOREIGN KEY (klienci_klient_id)
    REFERENCES restauracja.klienci (klient_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Reservation_Orders (table: rezerwacja)
ALTER TABLE restauracja.rezerwacja ADD CONSTRAINT Reservation_Orders
    FOREIGN KEY (id_zamow)
    REFERENCES restauracja.zamowienia (zamowienie_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: TableRes_Reservation (table: stolik_rezerwacja)
ALTER TABLE restauracja.stolik_rezerwacja ADD CONSTRAINT TableRes_Reservation
    FOREIGN KEY (rezerwacja_rezerwacja_id)
    REFERENCES restauracja.rezerwacja (rezerwacja_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: menu_kategorie (table: menu)
ALTER TABLE restauracja.menu ADD CONSTRAINT menu_kategorie
    FOREIGN KEY (kategoria_id)
    REFERENCES restauracja.kategorie (kategoria_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: stolik_rezerwacja_stolik (table: stolik_rezerwacja)
ALTER TABLE restauracja.stolik_rezerwacja ADD CONSTRAINT stolik_rezerwacja_stolik
    FOREIGN KEY (stolik_stolik_id)
    REFERENCES restauracja.stolik (stolik_id)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: zamowienia_typZamowienia (table: zamowienia)
ALTER TABLE restauracja.zamowienia ADD CONSTRAINT zamowienia_typZamowienia
    FOREIGN KEY (typZamowienia_id_zamow)
    REFERENCES restauracja.typZamowienia (id_zamow)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- End of file.

