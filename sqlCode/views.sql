
--1 widok na obecne MENU
CREATE OR replace VIEW restauracja.obecne_menu 
AS
SELECT pozycja_id, nazwa_dania, nazwa, cena 
FROM restauracja.menu
    INNER JOIN restauracja.kategorie k ON k.kategoria_id = restauracja.menu.kategoria_id
ORDER BY pozycja_id;


--2 widok wszystkich zamówień klientów
CREATE or replace VIEW restauracja.zamowienia_klientow AS
SELECT k.imie, 
       k.klient_id,
       z.zamowienie_id,
       tz.na_wynos,
       tz.odbior
FROM restauracja.zamowienia z
        INNER JOIN restauracja.klienci k ON k.klient_id = z.klienci_klient_id
        INNER JOIN restauracja.typZamowienia tz ON tz.id_zamow = z.typZamowienia_id_zamow
ORDER BY k.klient_id; 



--3 widok sprzezy kazdego produktu
CREATE or replace VIEW restauracja.sprzedaz_produktu AS
SELECT 
    m.pozycja_id,
    m.nazwa_dania, 
    Sum(ilosc) as Sold 
FROM restauracja.szczegolyZamowienia sz
inner join restauracja.zamowienia z on z.zamowienie_id = sz.zamowienie_id
inner join restauracja.menu m ON m.pozycja_id = sz.pozycja_id
group by m.pozycja_id, m.nazwa_dania;

-- 5 widok ten zwraca nam wszystkie rezerwacje stoliki VIP i nie
create or replace view restauracja.wykaz_rezerwacji AS
SELECT
    r.rezerwacja_id,
    k.imie,
    s.stolik_id,
    r.data,
    r.czas,
    s.ilosc_osob
FROM restauracja.rezerwacja r
INNER JOIN restauracja.zamowienia z ON z.zamowienie_id = r.id_zamow
INNER JOIN restauracja.klienci k ON k.klient_id = z.klienci_klient_id
INNER JOIN restauracja.stolik_rezerwacja sR ON sR.rezerwacja_rezerwacja_id = r.rezerwacja_id
INNER JOIN restauracja.stolik s ON s.stolik_id = sR.stolik_stolik_id
ORDER BY r.rezerwacja_id;

-- 6pokazuje tylko rezerwacje na stoliki VIP
create or replace view restauracja.wykaz_rezerwacji_vip AS
SELECT
    r.rezerwacja_id,
    k.imie,
    s.stolik_id,
    r.data,
    r.czas,
    s.ilosc_osob
FROM restauracja.rezerwacja r
INNER JOIN restauracja.zamowienia z ON z.zamowienie_id = r.id_zamow
INNER JOIN restauracja.klienci k ON k.klient_id = z.klienci_klient_id
INNER JOIN restauracja.stolik_rezerwacja sR ON sR.rezerwacja_rezerwacja_id = r.rezerwacja_id
INNER JOIN restauracja.stolik s ON s.stolik_id = sR.stolik_stolik_id
WHERE s.czy_vip = TRUE
ORDER BY r.rezerwacja_id;


--7 pokazuje listę wszystkich klientów , którzy mają dostępną zniżkę

create or replace view restauracja.wszyscy_klienci AS
SELECT 
    k.klient_id,
    k.imie,
    k.telefon,
    k.email,
    z.start,
    z.wygasa,
    z.procent_znizka
FROM restauracja.klienci k
INNER JOIN restauracja.znizki z ON z.klient_id = k.klient_id
ORDER BY k.imie;
