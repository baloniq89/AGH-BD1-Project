-- sprawdza czy znizka klienta nie skonczy się szybciej niż się zacznie (data rozpoczecia nastepuje pozniej od daty zakonczenia znizki w kalendarzu)
CREATE OR replace FUNCTION restauracja.sprawdz_znizke
  () returns TRIGGER
AS
  $$
BEGIN
  IF NEW.wygasa < NEW.start THEN
    RAISE
  EXCEPTION
    'Data wygaszenia znizki nie moze byc mniejsza od daty rozpoczecia';
    RETURN NULL;
  END IF;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER
IF EXISTS walidacja_znizka ON restauracja.znizki;
  CREATE TRIGGER walidacja_znizka BEFORE
  INSERT
  OR
  UPDATE
  ON restauracja.znizki FOR EACH ROW EXECUTE PROCEDURE restauracja.sprawdz_znizke();


-- sprawdza czy nie wpisano ujemnej wartości ceny w menu
  create or replace function restauracja.sprawdz_menu ()
  returns TRIGGER  AS
  $$
  DECLARE 
    x money := 0;
  BEGIN 
    IF NEW.cena < x  THEN
        RAISE
    EXCEPTION
        'Nie można wpisać ceny mniejszej od 0!!';
        RETURN NULL;
    END IF;
    RETURN NEW;
END;
$$
LANGUAGE plpgsql;
DROP TRIGGER
IF EXISTS walidacja_cena ON restauracja.menu;
  CREATE TRIGGER walidacja_cena BEFORE
  INSERT
  OR
  UPDATE
  ON restauracja.menu FOR EACH ROW EXECUTE PROCEDURE restauracja.sprawdz_menu();

--waliduje czy podana ilosc dań do zamowienia nie jest mniejsza lub równa 0
create or replace FUNCTION restauracja.sprawdz_szczegoly_zamowienia()
    returns TRIGGER
      AS
        $$
      BEGIN
        IF NEW.ilosc <= 0 THEN
          RAISE
        EXCEPTION
          'Ilosc musi byc wieksza od zera';
          RETURN NULL;
        END IF;
        RETURN NEW;
      END;
      $$
    LANGUAGE plpgsql;
      DROP TRIGGER
      IF EXISTS walidacja_szczegoly_zamowienia ON restauracja.szczegolyZamowienia;
        CREATE TRIGGER walidacja_szczegoly_zamowienia BEFORE
        INSERT
        OR
        UPDATE
        ON restauracja.szczegolyZamowienia FOR EACH ROW EXECUTE PROCEDURE restauracja.sprawdz_szczegoly_zamowienia();


--sprawdza czy podana ilosc osob do rezerwacji jest wieksza lub rowna 2

create or replace FUNCTION restauracja.sprawdz_stolik_rezerwacja()
    returns TRIGGER
      AS
        $$
      BEGIN
        IF NEW.ilosc_osob <= 1 THEN
          RAISE
        EXCEPTION
          'Stolik musi byc MIN na 2 osoby';
          RETURN NULL;
        END IF;
        RETURN NEW;
      END;
      $$
    LANGUAGE plpgsql;
      DROP TRIGGER
      IF EXISTS walidacja_stolik_rez ON restauracja.stolik;
        CREATE TRIGGER walidacja_stolik_rez BEFORE
        INSERT
        OR
        UPDATE
        ON restauracja.stolik FOR EACH ROW EXECUTE PROCEDURE restauracja.sprawdz_stolik_rezerwacja();