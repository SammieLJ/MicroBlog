Microblog Demo - Samir Subašiæ 2011 (od 15.09.2011 do 09.11.2011)

OPIS:
Demo sistem aplikacije vnosa kratkih sporoèil in urejanje sporoèil ter uporabnikov. 
Aplikacija vsebuje:
- sistem prepoznave uporabnika (logiranje), 
- branje sporoèil, 
- vnos sporoèil,
- urejanje že vnešenega sporoèila, 
- brisanje sporoèila, 
- sprememba uporabnikovega gesla, 
- deaktivacijo uporabnikov 
- dodajanje novih uporabnikov.
- uporabniki se delijo na administratorje, pisce in bralce
- administrator lahko popravlja ali briše vnešena sporoèila, vnaša nova sporoèila in lahko deaktivira ali dodaja novega uporabnika
- pisec lahko vnaša nova sporoèila in popravlja samo svoja sporoèila. Ne more brisati.
- bralec lahko samo bere sporoèila

NAMEN:
Demonstriranje v delovni karieri pridobljenih znanj pri izgradnji demo spletne aplikacije kot celotnega produkta. 
Zanja kot so:
- planiranje funkcionalnosti celotne aplikacije in doloèitev èasovnega roka (5 delovnih dni)
- priprava okolja izvedbe aplikacije
- planiranje designa aplikacije
- izgradnja podatkovnih tabel in CRUD stavki v podatkovni bazi na mysql
- napisal samostojni kontroler (brez uporabe php knjižnic) in samostojno tako klient in kot strežniško validacijo podatkov (pred vpisom v db)
- poskrbel za vse aspekte varnosti aplikacije in funkcionalnost aplikacije (v nobenem primeru se aplikacija ne sme "presenetiti" s dvomljivimi podatki)
- uporabil testni scenarij pri testiranju funkcionalnosti aplikacije.
- demo aplikacija deluje le na PHP ver. 5.3 ker uporablja "namespaces" funkcionalnost
- pri demu je bil uporabljen jQuery (ki je priložen v dir. "scripts"). Uporabljen je za validacijo vnešenih ali izbranih podatkov v brskalniku, izraèun višine prikaza sporoèil. 

UPORABA:
V podatkovni bazi mysql (aplikacija samo to bazo podpira) kreiramo podatkovno zbirko (bazo) s imenom "microblog". (lahko tudi poljubno ime)
Zaženemo skripto v mysql urejevalniku s imenom microblog-demo.sql (nahaja se v direktoriju /microblog-demo/SQL/). Kerirale se nam bodo tri tabele s 
pripravljenimi testnimi podatki.
Paket microblog-demo.zip skopiramo v direktorij, ki je root Apache strežniku (recimo "htdocs"). Poišèemo datoteko "ConfigDB.php", ki se nahaja v 
"/Microblog-demo/classes/Microblog/Config". V datoteko vpišemo: 
- naslov našega mysql strežnika, ponavadi je to 'localhost'. DbAddress = 'localhost';
- uporabniško ime za dostop do mysql-a. DbUsername = 'root';
- geslo za dostop do mysql-a. DbPassword = 'root';
- vpišemo še podatkovno bazo v mysql-u, kjer smo kreirali tabele. DbDatabase = 'microblog';

Sedaj nastavimo naslov v spletnem brskalniku na: http://localhost/microblog-demo/index.php (localhost je naš lokalni strežnik, lahko je poljubno) in prikazalo se nam bo prijavno okence. 
Vpišemo predpripravljeno uporabniško ime 'root' in geslo 'dummy'. Ko smo se prijavili s uporabniškim imenom root, kliknemo na "Uredi uporabnike". Odpre se nam okno "Uporabniške nastavitve".
Sedaj vpišemo, kot prvo, svojega uporabnika, ki bo imel vlogo administratorja in po želji še ostale uporabnike razliènih vlog. Ko smo konèali s dodajanjem uporabnikov, lahko deaktiviramo
predpripravljenega uporabnika 'root'. Izberemo ga iz spodnjega seznama (klik na izberi) in s klikom na gumb 'Deaktiviraj uporabnika' ga dokonèno odstranimo iz uporabnikov.