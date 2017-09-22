Microblog Demo - Samir Suba�i� 2011 (od 15.09.2011 do 09.11.2011)

OPIS:
Demo sistem aplikacije vnosa kratkih sporo�il in urejanje sporo�il ter uporabnikov. 
Aplikacija vsebuje:
- sistem prepoznave uporabnika (logiranje), 
- branje sporo�il, 
- vnos sporo�il,
- urejanje �e vne�enega sporo�ila, 
- brisanje sporo�ila, 
- sprememba uporabnikovega gesla, 
- deaktivacijo uporabnikov 
- dodajanje novih uporabnikov.
- uporabniki se delijo na administratorje, pisce in bralce
- administrator lahko popravlja ali bri�e vne�ena sporo�ila, vna�a nova sporo�ila in lahko deaktivira ali dodaja novega uporabnika
- pisec lahko vna�a nova sporo�ila in popravlja samo svoja sporo�ila. Ne more brisati.
- bralec lahko samo bere sporo�ila

NAMEN:
Demonstriranje v delovni karieri pridobljenih znanj pri izgradnji demo spletne aplikacije kot celotnega produkta. 
Zanja kot so:
- planiranje funkcionalnosti celotne aplikacije in dolo�itev �asovnega roka (5 delovnih dni)
- priprava okolja izvedbe aplikacije
- planiranje designa aplikacije
- izgradnja podatkovnih tabel in CRUD stavki v podatkovni bazi na mysql
- napisal samostojni kontroler (brez uporabe php knji�nic) in samostojno tako klient in kot stre�ni�ko validacijo podatkov (pred vpisom v db)
- poskrbel za vse aspekte varnosti aplikacije in funkcionalnost aplikacije (v nobenem primeru se aplikacija ne sme "presenetiti" s dvomljivimi podatki)
- uporabil testni scenarij pri testiranju funkcionalnosti aplikacije.
- demo aplikacija deluje le na PHP ver. 5.3 ker uporablja "namespaces" funkcionalnost
- pri demu je bil uporabljen jQuery (ki je prilo�en v dir. "scripts"). Uporabljen je za validacijo vne�enih ali izbranih podatkov v brskalniku, izra�un vi�ine prikaza sporo�il. 

UPORABA:
V podatkovni bazi mysql (aplikacija samo to bazo podpira) kreiramo podatkovno zbirko (bazo) s imenom "microblog". (lahko tudi poljubno ime)
Za�enemo skripto v mysql urejevalniku s imenom microblog-demo.sql (nahaja se v direktoriju /microblog-demo/SQL/). Kerirale se nam bodo tri tabele s 
pripravljenimi testnimi podatki.
Paket microblog-demo.zip skopiramo v direktorij, ki je root Apache stre�niku (recimo "htdocs"). Poi��emo datoteko "ConfigDB.php", ki se nahaja v 
"/Microblog-demo/classes/Microblog/Config". V datoteko vpi�emo: 
- naslov na�ega mysql stre�nika, ponavadi je to 'localhost'. DbAddress = 'localhost';
- uporabni�ko ime za dostop do mysql-a. DbUsername = 'root';
- geslo za dostop do mysql-a. DbPassword = 'root';
- vpi�emo �e podatkovno bazo v mysql-u, kjer smo kreirali tabele. DbDatabase = 'microblog';

Sedaj nastavimo naslov v spletnem brskalniku na: http://localhost/microblog-demo/index.php (localhost je na� lokalni stre�nik, lahko je poljubno) in prikazalo se nam bo prijavno okence. 
Vpi�emo predpripravljeno uporabni�ko ime 'root' in geslo 'dummy'. Ko smo se prijavili s uporabni�kim imenom root, kliknemo na "Uredi uporabnike". Odpre se nam okno "Uporabni�ke nastavitve".
Sedaj vpi�emo, kot prvo, svojega uporabnika, ki bo imel vlogo administratorja in po �elji �e ostale uporabnike razli�nih vlog. Ko smo kon�ali s dodajanjem uporabnikov, lahko deaktiviramo
predpripravljenega uporabnika 'root'. Izberemo ga iz spodnjega seznama (klik na izberi) in s klikom na gumb 'Deaktiviraj uporabnika' ga dokon�no odstranimo iz uporabnikov.