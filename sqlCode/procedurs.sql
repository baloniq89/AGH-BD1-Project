


--1 prodedura dodajace rezerwacje dla klienta

create or replace function restauracja.dodaj_rezerwacje (
    clientID int,
    people int,
    vip boolean,
    whichDay date,
    hour time
)returns void AS
$$
DECLARE
    tableID int := 0 ;
    reservationID int := 0;
    orderID int := 0;
    tableResId int := 0;
BEGIN 
    reservationID := (SELECT MAX(rezerwacja_id) FROM restauracja.rezerwacja);
    reservationID := reservationID + 1;
    

    tableID := (SELECT stolik_id FROM restauracja.stolik s WHERE(s.ilosc_osob = people AND s.czy_vip = vip));

    tableResId :=(SELECT MAX(stolik_rezerwacja_id) FROM restauracja.stolik_rezerwacja);
    tableResId := tableResId + 1;

    PERFORM restauracja.dodaj_zamowienie(clientID, 'no', NULL);
    orderID := (SELECT MAX(zamowienie_id) FROM restauracja.zamowienia z WHERE z.klienci_klient_id = clientID);

    INSERT INTO restauracja.rezerwacja
    (
        rezerwacja_id,
        id_zamow,
        data,
        czas
    )
    VALUES
    (
        reservationID,
        orderID,
        whichDay,
        hour

    );

    INSERT INTo restauracja.stolik_rezerwacja
    (
        stolik_rezerwacja_id,
        rezerwacja_rezerwacja_id,
        stolik_stolik_id
    )
    VALUES
    (
        tableResId,
        reservationID,
        tableID
    );


END;
$$
LANGUAGE 'plpgsql';



--2 procedura dodajaca zamowienie dla klienta o podanym ID


create or replace function restauracja.dodaj_zamowienie(
        clientID int,
        orderType boolean,
        takeOut date = NULL
 ) returns void AS
$$
DECLARE
    orderTypeID int := 0;
    orderID int := 0;
BEGIN
    IF orderType IS NULL THEN
            orderTypeID := 1;

            INSERT INTO restauracja.typZamowienia 
            (
                id_zamow,
                na_wynos,
                odbior
            )
            VALUES
            (
                orderTypeID,
                orderType,
                takeOut
            );

            INSERT INTO restauracja.zamowienia
            (
                zamowienie_id,
                klienci_klient_id,
                typZamowienia_id_zamow
            )
            VALUES
            (
                orderID,
                clientID,
                orderTypeID
            );
    ELSE 
            orderTypeID := (SELECT MAX(id_zamow) FROM restauracja.typZamowienia);
            orderTypeID := orderTypeID + 1;
        

            orderID := (SELECT MAX(zamowienie_id) FROM restauracja.zamowienia);
            orderID := orderID + 1;

            INSERT INTO restauracja.typZamowienia 
            (
                id_zamow,
                na_wynos,
                odbior
            )
            VALUES
            (
                orderTypeID,
                orderType,
                takeOut
            );

            INSERT INTO restauracja.zamowienia
            (
                zamowienie_id,
                klienci_klient_id,
                typZamowienia_id_zamow
            )
            VALUES
            (
                orderID,
                clientID,
                orderTypeID
            );
    END IF;
END;
$$
LANGUAGE 'plpgsql';



--3 procedura dodajaca pozycje do zamowienia przyjmuje parametry(pozycja id , ilosc, oraz id zamowienia)
create or replace function restauracja.dodaj_do_zamowienia(
        PositionID int,
        Quantity int,
        OrderID int
) returns void AS
 $$ 
DECLARE 
    PositionPrice   money := 0;
BEGIN
    PositionPrice := (SELECT cena FROM restauracja.menu WHERE restauracja.menu.pozycja_id  = PositionID);

INSERT INTO
    restauracja.szczegolyZamowienia (
        zamowienie_id,
        pozycja_id,
        cena_pozycji,
        ilosc
    )
VALUES
    (
        OrderID,
        PositionID,
        PositionPrice,
        Quantity
    );
END;
$$
LANGUAGE 'plpgsql';


--4 funkcja zwracajaca podsuwanie calego zamowienia o podanych ID, zwraca imiei telefon klienta, co zamowił oraz ile
CREATE or replace FUNCTION restauracja.podsumowanie_zamowienia(orderID int)
RETURNS TABLE(Imie varchar, telefon varchar,potrawa varchar, ilosc int, suma money , Czy_na_wynos boolean) AS
$$
    SELECT k.imie, k.telefon, m.nazwa_dania, sZ.ilosc,  (sz.ilosc * sZ.cena_pozycji) as suma ,tZ.na_wynos 
    FROM restauracja.szczegolyZamowienia sZ
    INNER JOIN restauracja.zamowienia z ON z.zamowienie_id = sZ.zamowienie_id
    INNER JOIN restauracja.menu m ON m.pozycja_id  = sZ.pozycja_id
    INNER JOIN restauracja.klienci k ON k.klient_id = z.klienci_klient_id
    INNER JOIN restauracja.typZamowienia tZ ON tZ.id_zamow = z.typZamowienia_id_zamow
    WHERE sZ.zamowienie_id = orderID
$$
LANGUAGE SQL;
