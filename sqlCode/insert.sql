

INSERT INTO restauracja.klienci(klient_id, imie, telefon, email) VALUES
('1', 'Anna', '809 745 321', 'anna@gmail.com'),
('2', 'Anonim', '321 123 321', 'ano21min@onet.pl'),
('3', 'Tomasz', '321 321 100', 'ttommy@wp.pl');

INSERT INTO restauracja.kategorie(kategoria_id, nazwa) VALUES
('1', 'Przystawki'),
('2', 'Dania główne'),
('3', 'Zupy'),
('4', 'Dania z kurczaka'),
('5', 'Pizza'),
('6', 'Makarony');



INSERT INTO restauracja.menu(pozycja_id, kategoria_id, nazwa_dania, cena) VALUES
('1', '1', 'Śledź w śmietanie', '12'),
('2', '1', 'Tatar', '26'),
('3', '2', 'Kotlet schabowy','30'),
('4', '2', 'Placki po węgierski','25'),
('5', '3', 'Rosół z kury','10'),
('6', '3', 'Pomidorowa','11'),
('7', '4', 'Wątróbka drobiowa','19'),
('8', '4', 'Roladki drobiowe','29'),
('9', '5', 'Capriciosa','24'),
('10', '5', 'Farmerska','27'),
('11', '6', 'Spaghetti Bolognese','16'),
('12', '6', 'Makaron Penne z kurczakiem','20');


INSERT INTO restauracja.stolik(stolik_id, ilosc_osob, czy_vip) VALUES
('1','2','TRUE'),
('2','3','NO'),
('3','3','NO'),
('4','3','TRUE'),
('5','4','NO'),
('6','4','NO'),
('7','4','TRUE'),
('8','4','TRUE'),
('9','5','TRUE'),
('10','5','NO'),
('11','6','NO'),
('12','6','NO'),
('13','6','TRUE'),
('14','8','NO'),
('15','8','TRUE');

INSERT INTO restauracja.typZamowienia(id_zamow, na_wynos, odbior) VALUES (1, 'no', NULL);
INSERT INTO restauracja.zamowienia(zamowienie_id, klienci_klient_id, typZamowienia_id_zamow) VALUES(1, 2, 1);
INSERT INTO restauracja.rezerwacja(rezerwacja_id, id_zamow, data, czas) VALUES (1, 1, '2022-02-11', '18:00');
INSERT INTO restauracja.stolik_rezerwacja(stolik_rezerwacja_id, rezerwacja_rezerwacja_id, stolik_stolik_id) VALUES (1, 1, 9);

/*
INSERT INTO restauracja.typZamowienia(id_zamow, na_wynos, odbior) VALUES
('1', 'no',NO),
('2', 'yes', '2022-02-12'),
('3', 'yes', '2022-02-08');
INSERT INTO restauracja.zamowienia(zamowienie_id, klienci_klient_id, typZamowienia_id_zamow) VALUES
('1', '1', '1'),
('2', '1', '2'),
('3', '2', '3');


INSERT INTO restauracja.szczegolyZamowienia(zamowienie_id, pozycja_id, cena_pozycji, ilosc, znizka) VALUES
('1', '8', '29', '2', '0.20'),
('2', '4', '25', '1', NULL),
('3', '1', '12', '3', '0.1');

INSERT INTO restauracja.rezerwacja(rezerwacja_id, id_zamow, data, czas) VALUES
('1', '1', '2022-02-09', '17:00');

INSERT INTO restauracja.stolik(stolik_id, rezerwacja_rezerwacja_id, ilosc_osob, czy_vip) VALUES
('1', '1', '5', 'yes');
*/
/******** znizki *********/
INSERT INTO restauracja.znizki(znizka_id, klient_id, start, wygasa, procent_znizka) VALUES
(1, 1, '2022-02-05', '2022-02-13', '0.2'),
(2, 2, '2022-02-05', '2022-02-13', '0.3');
