# Kaugummi-Artikelverwaltung
## Problembeschreibung
Wir haben hier ein Legacy-Projekt eines Kunden in Form der beiliegenden `index.php` zur Wartung übergeben bekommen.

Der Kunde ist ein großer Kaugummilieferant, das Projekt dient der Verwaltung des Produktsortiments.  
Soweit es nachvollziehbar ist, wurde das Projekt ursprünglich im familiären Umfeld des Firmenvorstandes von einem „Programmier-Profi“ geschaffen.

Seit einem Serverupdate funktioniert die Anwendung nicht mehr wie erwartet.  
Eine genaue Diagnose liegt uns noch nicht vor, es wird von „weißen Seiten“ und „irgendwelchen kryptischen Meldungen“ berichtet.

## Briefing
Diese Anforderungen hat uns der Kunde im Briefing übergeben:
* Die Anwendung soll wieder funktionieren.
* „Da waren manchmal so Fehler, wenn man was geändert hat“ – das soll bitte direkt mit behoben werden.
* Es soll wenigstens ein bisschen besser aussehen.
* Die Usability soll verbessert werden.
 
## Anforderungen
* Die Anwendung – bzw. der Code – soll durch Kommentierung und Struktur in einen Zustand gebracht werden, der Wartung und Weiterentwicklung vereinfacht.
* Die Oberfläche soll W3C-konform sein.
* Die Datenbankstruktur darf gerne optimiert werden.
* Das Environment ist ein Apache-Webserver mit MariaDB als DBMS.
* Die Anwendung soll ausdrücklich *ohne* PHP-Framework aufgesetzt werden. 

## Hinweise
* Ob Du die bestehende Anwendung reparierst oder alles neu erstellst, bleibt Dir überlassen.  
* Bitte teile uns mit, wie lange Du für die Lösung benötigt hast.
* Im Idealfall sendest Du uns die Lösung als git-Repository. Wir sehen gerne die Lösungswege.

Viel Spaß!

---

## Annahmen

- VPN Zugang wird benötigt um die Webseite zuerreichen.
- Keine Unautorisierten Personen können auf die Seite zugreifen.

Begründung: Es gab keine Authentifizierung oder Authorisierung im Umsprung script

- Eingabe vom Preis ist im format `XXXX,XX`

## Mögliche optimierungen

## Architecture
- Es wäre möglich die Datenbank calls in eine DB Klasse zu extrahieren, wodurch die `ChewingGum` Klasse kleiner wird, und somit auch weniger Verantwortung hat.

### Datenbank
- Es könnte eine Tabelle `typen` angelegt werden um die unterschiedlichen Kaugummi Geschmäcker leichter zu erweitern.

## Sicherheit
- Derzeit werden die "Pages" per include und dem `$_GET` parameter gesteuert, dies kann dazu führen das ein Attacker eventuell zugriff auf andere Daten bekommt
  - Möglicher angriff könnte sein `?page=../../.ssh/config` 
  - mit der Annahme das die Seite im `home` vom einem User liegt
  - Dies sollte jedoch kein Problem sein solange die Annahme mit dem VPN gegeben ist.