---
...
Redovisning
=========================



Kmom01
-------------------------

### Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?
Jag tyckte det gick ganska bra. Jag har programmerat lite objektorienterat i Java (och C++) för länge sedan och det verkar som att jag inte glömt av allt helt och hållet. En del syntax skiljer sig lite åt från Java men annars är likheterna rätt stora (åtminstone så som jag minns det).

### Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?
Efter en liten lätt uppfräschning av minnet om hur GET, POST, SESSION funkar i PHP så gick det utan problem. Jag valde att dela upp det i en ”view”-del med html-koden för sidan och formuläret där get- och post-delen använder samma fil (method sätts med en variabel).

### Har du några inledande reflektioner kring me-sidan och dess struktur?
Det kändes lite rörigt att hitta i alla filer och mappar inledningsvis. Det tog mig t.ex. ett bra tag att hitta hur jag kunde lägga till en flash-region på sidan. Men när man fyller sidan med mer innehåll sedan så kommer det säkert visa sig vara en logisk och rimlig struktur.

### Vilken är din TIL för detta kmom?
Det mesta vad det gäller hur klasser fungerar i PHP. Ska jag nämna något mer specifikt så kan jag nämna användandet av ”autoload” som jag tyckte var lite fiffigt.



Kmom02
-------------------------

### Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida? 
Med hjälp av video-serien gick det bra. Det var dock en del småsaker att fixa som inte kändes helt självklara (t.ex. att fixa autoloader-delen i composer.json) så utan utförliga instruktioner hade jag förmodligen stött på en del problem.

### Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod? 
Min tanke var att återanvända Dice- och DiceHand-klasserna från oophp2-uppgiften och komplettera med en klass för själva spelet. Till att börja med försökte jag sedan få till logiken i spelet för mänskliga spelare. Därefter försökte jag få datorspelaren att spela någorlunda intelligent. Till sist en del småfix i presentationen av spelet samt att jag la in stöd för spel med mer än en tärning. Sammanfattningsvis får jag säga att det var en ganska utmanande veckouppgift som tog mig ganska mycket tid att genomföra.

### Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc? 
Ett UML-diagram tycker jag ger en kompakt och lätt överblickbar bild över klasserna och dess relationer. Det ger ett bra sätt att skissa på hur klasserna ska se ut innan man börjar koda dem. Nackdelen är att det känns lite ineffektivt att för hand sitta och modellera UML-diagram i verktyg som draw.io. Dokumentation med phpDocumentor blir ju lite längre men också utförligare och går ju också att generera automatiskt utfrån hur koden faktiskt ser ut när man är klar. All dokumentation som går att enkelt generera automatiskt gillar jag så make doc var trevligt.

### Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?
När man ska ta en liten sida som gissa tal-sidan och flytta in den i ramverket så får jag erkänna att det kändes lite omständigt med alla förändringar av koden som behövde göras samt att behöva ha koden uppdelad på så många olika ställen. Givet större projekt och att man redan från början programmerar i ramverket ser jag dock fördelar med att strukturera koden som den görs där.

###Vilken är din TIL för detta kmom? 
namespace i PHP och hur det används. Samt hur man kan generera dokumentation med phpDocumentor och make doc.

### Övrigt och extrauppgifter
Jag lade in även GET och POST-varianterna för gissa tal-spelet samt gjorde det möjligt att spela tärningsspel 100 även med fler än en tärning.



Kmom03
-------------------------

### Har du tidigare erfarenheter av att skriva kod som testar annan kod?
Nej jag har ingen tidigare erfarenhet erfarenhet av att skriva enhetstester eller annan kod för testning så det var intressant att bekanta sig lite med detta första gången.

### Hur ser du på begreppen enhetstestning och att skriva testbar kod?
Det kräver ju att man hela utvecklingsprocessen tänker på att koden man skriver ska bli testbar så det blir ju ytterligare en dimension att ta hänsyn till. Vilket för en nybörjarprogrammerare kan kännas lite jobbigt eftersom det brukar vara tillräckligt mycket att tänka på ändå. Den stora fördelen med enhetstestning ser jag framförallt om man senare behöver skriva om delar av koden. Då ger enhetstestning möjlighet att se att ingen annan del i koden gick sönder.

### Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord. 
* White box testing: Testningen sker på källkodsnivå och man har också full insyn i källkoden och har möjlighet att testa varje enskild del av koden.

* Black box testing: Här har man inte ha tillgång tillgång till källkoden och det är inte väsentligt hur koden är skriven utan det man vill testa är funktionaliteten.

* Grey box testing: Kan ses som kombination av de två föregående begreppen. Vid grey box testing har man viss kunskap om den bakomliggande koden t.ex. tillgång till dokumentation och kännedom om vilka algoritmer som används.

* Positiva tester: Tester utformade för att verifiera att programmet fungerar som det är tänkt. T.ex. givet en specifik (korrekt) indata ska programmet ge förväntad utdata.

* Negativa tester: Tester uformade för att generera fel i programmet. T.ex. om ålder efterfrågas i ett formulär kan ett test vara att skriva in bokstäver istället för siffror.

### Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?
Det gick bra. Jag använde min egna Guess-klass som förvisso var snarlik exempel-klassen. Dice-klasserna tror jag hade behövt skriva om delar av för att lyckas testa fullt ut vilket jag avstod.

### Vilken är din TIL för detta kmom? 
Jag har fått en första inblick i vad enhetstestning är, ett begrepp som jag hört tidigare men aldrig greppat vad det rent konkret innebär.



Kmom04
-------------------------

### Vilka är dina tankar och funderingar kring trait och interface? 
Interface syfte och användning känns ganska klar för mig. Trait har jag däremot fortfarande en del frågetecken kring t.ex. gällande i vilka situationer det är ”rätt” lösning. Det uppges som en ersättning till avsaknaden av multipelt arv men multipelt arv brukar väl å andra sidan sällan vara ”rätt” lösning i OOP ens i de språken som stödjer det? Andra beskrivningar jag hittar av trait är att det bara ska ses som en ”compiler-assisted copy-and-paste” och min uppfattning av trait är att det nog känns som en mer passande beskrivning.

### Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du? 
Först hade jag en idé om att använda en exakt optimal spelstrategi genom beräkna sannolikheterna för vinna om man fortsätter kasta respektive stannar givet hur många poäng datorn har totalt, hur många poäng spelaren har totalt och hur många poäng datorn har hittills i spelomgången. Det visade sig dock bli ett komplext problem som det skrivits [mindre avhandlingar om](http://cs.gettysburg.edu/~tneller/papers/pig.zip) så det kändes lite för ambitiöst att försöka lösa och programmera det. Istället nöjde jag mig med en lösning som approximerar optimal spelstrategi med ett antal parametrar enligt följande:

Låt _i_ vara datorns totala poäng, _j_ vara spelarens totala poäng samt _k_ antalet poäng datorn uppnått i den nuvarande omgången. Låt då datorn fortsätta kasta om antingen _i_ >= 100 - _e_ eller _j_ >= 100 - _e_. Annars låt datorn fortsätta kasta om _k_ < _c_ + (_j_ - _i_) / _d_. Där parametrarna _c_, _d_, _e_ sätts till 21, 8 resp. 29. Källa: [”Practical Play of the Dice Game Pig”](http://cs.gettysburg.edu/~tneller/papers/umap10.pdf).

Det kommer innebära att datorn fortsätter kasta för att försöka uppnå 100 poäng i nuvarande omgång om någon av spelarna har 71 poäng eller mer. Hur aggressivt datorn spelar kommer annars vara beroende av hur många poäng före eller efter den ligger motståndaren.

### Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur? 
Fördelarna som nämns i uppgiften antar jag överväger nackdelarna. Men en uppenbar nackdel är ju annars om man en dag vill bryta ut koden (spelet i det här fallet) och använda det på någon annan sida utanför ramverket då man måste skriva om stora delar av koden. 

### Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick. 
Jag stötte på lite problem med felmeddelanden för .js-filerna i build-mappen så jag exkluderade den mappen. I övrigt stötte jag inte på några problem med make test. Några rader och metoder fick jag hoppa över att enhetstesta men jag nådde ändå en kodtäckning på 90+% sett till rader och metoder.

### Vilken är din TIL för detta kmom?
Även om jag som sagt fortfarande har vissa frågetecken kring användandet av trait så får jag ändå säga att trait och interface och exempel på hur de kan användas är veckans TIL för mig.



Kmom05
-------------------------

### Några reflektioner kring koden i övningen för PHP PDO och MySQL?
PHP PDO använde vi ju redan i den första htmlphp-kursen fast med SQLite istället för MySQL så det som kändes nytt var främst kopplingen mot MySQL och att PDO-koden lades in i en ”wrapper-klass”. I övrigt tyckte jag att det var bra med påminnelse om säkerhetsaspekter på koden eftersom det är lätt att man glömmer bort det som nybörjare. Intressant också att se hur man kan lösa sortering och paginering på ett smart sätt.

### Hur gick det att överföra koden in i ramverket, stötte du på några utmaningar?
Utmaningen var främst att lyckas strukturera koden på ett bra sätt och t.ex. inte frestas att trycka in allting i routen. Jag tycker att jag åtminstone delvis lyckades undvika det.

### Berätta om din slutprodukt för filmdatabasen, gjorde du endast basfunktionaliteten eller lade du till extra features och hur tänkte du till kring användarvänligheten och din kodstruktur?
Utöver grundkraven lade jag in stöd för att återskapa databasen, sortering, paginering, Cimage för bilderna och en inloggningsfunktion. Vad det gäller användarvänligheten tyckte jag den fungerade ganska bra i övningen. Jag valde därför att inte göra några direkta förbättringar av den utan refaktorerade i stort sett bara koden, förutom de delar som saknades (t.ex. inloggningsfunktionen).

För inloggningsfunktionen skapade jag en ny tabell för användare och deras hashade lösenord. CRUD-sidan och sidan för att återskapa databasen dolde jag sedan för icke inloggade användare.

Vad det gäller kodstrukturen så lade jag all databaskod i en klass MovieDB för att få bort den från routen vilket jag tyckte blev ganska bra. Dock hade man kanske kunnat börja med att göra en mer generell DB-klass som man hade kunnat återanvända i andra sammanhang. Det som är kvar i routen som man nog borde överväga att flytta är en del verifiering (av t.ex. om användaren är inloggad eller inte). Men tiden rann iväg lite och jag valde att fokusera på att få till funktionaliteten.

### Vilken är din TIL för detta kmom?
Framförallt känner jag att jag kommit in lite mer i Anax och ramverkstänket efter veckans uppgift. Några saker som jag inte riktigt förstått tidigare trillade på plats nu med t.ex. hur man kan använda klasserna och metoderna som hör till Anax.



Kmom06
-------------------------

### Hur gick det att jobba med klassen för filtrering och formatering av texten?
Att få till de fyra grundfiltren gick utan problem och jag tyckte det var en av de enklare delarna i detta kmom.

Jag gjorde också ett försök med att få till ett HTML Purifier-filter som jag såg att Anax egen TextFilter-klass hade stöd för. Det hade känts bra att köra artikeltexterna genom detta istället för att helt lita på att användarna inte lägger in icke välkomna script och taggar. Tyvärr fick jag det dock inte riktigt att fungera när jag testade att lite snabbt lägga in det i min egna klass och jag valde att inte lägga tid på att felsöka det närmare.

### Berätta om din klasstruktur och kodstruktur för din lösning av webbsidor med innehåll i databasen.
Jag insåg ganska snabbt att det var många delar vad det gäller databaskoden till CMS-uppgiften som var lik filmuppgiften i förra veckans kmom. Jag började därför med att skriva en ny gemensam databasklass “BaseDB”. Därefter skrev jag en ny filmdatabasklass och en content-databasklass som ärver från “BaseDB” men lägger till lite extra metoder som krävs i resp. klass. 

### Hur känner du rent allmänt för den koden du skrivit i din me/redovisa, vad är bra och mindre bra? Ser du potential till refactoring av din kod och/eller behov av stöd från ramverket?
Jag blev ganska nöjd med min lösning för databaskoden ovan och att jag slapp duplicera så mycket kod mellan film-databaskoden och content-databaskoden. Sedan finns det helt säkert bättre sätt att göra det på.

Det finns en del kod i routen som upprepas ganska mycket, t.ex. koden för att se om en användare är inloggad eller inte. Det hade man ju önskat få i någon middleware-lösning odyl. istället som vi gjorde i databaskursen. Det finns även en del annan verifieringskod i routen som man nog hade kunnat få till på ett bättre sätt.

### Vilken är din TIL för detta kmom?
Jag insåg att jag inte riktigt förstått när man bör använda arv och när man bör använda komposition när jag läste det avsnittet i kmom02. Läste lite mer om ämnet nu och blev kanske lite klokare. Den allmänna åsikten verkar vara att man ska “favour composition over inheritance”.

### Övrigt och extrauppgifter
Utöver grundkraven har jag lagt till inloggning, möjlighet för inloggade användare att se borttagna och ej publicerade artiklar, möjlighet att återskapa borttagna artiklar, paginering/sortering på admin-sidan som visar allt innehåll, samt att det loggas vem som skapat en artikel/bloggpost.

Som ej inloggad användare kan man bara se en överblick av publicerade [webbsidor](content/article) och [bloggposter](content/blog) med länkar till resp. artikel/post.

Som inloggad användare kan man på dessa båda sidor även se borttagna och ej publicerade artiklar/poster. Man kommer också åt [adminsidan](content/show) med allt innehåll där man kan klicka vidare för att redigera en artikel, ta bort en artikel eller återskapa en borttagen artikel. För inloggade användare finns också en sida för att [skapa nya artiklar](content/create).

En av de saker som vållade mig mest problem var hur path och slug skulle hanteras. Skulle det finnas möjlighet att sätta path för bloggposter och slug för sidor? Det verkade inte finnas någon tanke för att använda dem på det sättet så jag valde att dölja inmatningen av de kombinationerna på redigeringssidan för användarna. Slug sätts sedan till null för sid-typen medan för post-typen så autogenereras en path av typen blogpost_{id}.

För sid-typen sätts path som default till null när man skapar en ny sida och användaren får alltså fylla i den själv. För bloggposter autogenereras en slug när man skapar en ny sida eller lämnar fältet tomt (men användaren kan förstås ändra den).

Kombinationen av att användare själva skulle ha möjlighet att sätta sin egen path och slug samtidigt som de behöver vara unika var också lite klurig att lösa. Jag valde att lägga på _{id} i slutet på pathen/slugen om den angivna pathen/slugen redan finns. Bättre hade kanske varit att informera användaren om att pathen/slugen redan existerar och be användaren ange en ny.



Kmom07-10
-------------------------

### 1. Projektet

#### Krav 1
Jag valde att skapa en sajt Kloss.db som samlar produktinformation och nyheter om Lego.

* [Förstasidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/): Jag valde att göra krav 4 också så förstasidan beskrivs under den punkten.
* [Produktsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products): Här visas alla produkter i ett listläge med en miniatyrbild. Det finns paginering och det går att ändra antal produkter per sida och sorteringsordning. Klickar man på en produktlänk kommer man till en [produktsida](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products/show?id=21309) med mer information om produkten och en större bild.
* [Bloggsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog): Här visas alla blogginlägg med rubrik och första stycket av inlägget samt en bild (om det finns med en i första stycket). Sidan har paginering och det visas fem blogginlägg per sida. Klickar man på ett [inlägg](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog?post=valkommen-till-kloss-db) kan man läsa det i dess helhet.
* [Om-sidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/om): Kort info om sidan visas här.
* Header: En logga och namnet på sajten visas till vänster i headern.
* Footer: Texten “© Kloss.db” visas centrerat i footern.
* Navbar: Länkar till förstasidan, produktsidan, bloggen och om-sidan finns i navbaren. Längst uppe i högra hörnet på sidan finns också en inloggningsikon som länkar till inloggningssidan. Är man väl inloggad syns istället en utloggningsikon samt en användarikon som länkar till profilsidan för användaren.

#### Krav 2
Jag har genomfört enhetstester på alla mina egna klasser. Dock består de nästan uteslutande av databasklasser vilket gjorde det lite trixigt att testa. Jag har löst det genom att skapa “reset”-sql-filer som återställer resp. tabell med ursprungsinnehållet för att man ska vara säker på att man testar mot förväntat innehåll. Jag skapade också en lokal konfigfil för databasanslutningen i test-katalogen (database.php). Efter det nådde jag [“grönt” resultat](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/doc/codecoverage.png) för testade rader och metoder i mina klasser (70%+).

Dokumentation är genererad med phpdoc. (Jag fick dock en mängd varningsmeddelanden efter uppgradering till PHP 7.2 som phpdoc [inte verkar helt kompatibelt](https://github.com/phpDocumentor/phpDocumentor2/issues/1914) med men dokumentationen verkar genereras ändå).

Rent allmänt om kodstrukturen så byggde jag vidare på koden jag skrivit från de tidigare kursmomenten med en bas-databasklass som sedan andra databasklasser ärver. Jag vet inte om det är det bästa sättet att hantera databaskoden på men det har åtminstone gjort att jag sluppit upprepa så mycket databaskod och jag har kunnat hålla routerna fri från databaskod. Totalt blev det fem route-filer, en för konton/inloggning, en för bloggdelen, en för produktsidan, en för spelet och en för förstasidan.

#### Krav 3
Via inloggningsikonen uppe till höger på sidan kan man [logga in](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/account/login) som admin med admin/admin som user/pass.

Inloggad som admin ser man på [produktsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products) en admin-navbar samt för varje produkt syns en ikon för att redigera resp. ta bort en skapad produkt. Klickar man på [redigera](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products/edit?id=21309) kommer man till ett formulär där man kan ändra informationen om produkten. Klickar man på [ta bort](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products/delete?id=21309) hamnar man först på en sida där man får bekräfta att man vill ta bort produkten därefter tas produkten bort från tabellen i databasen. Inloggad som admin har man också möjlighet att [lägga till nya produkter](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products/create). Det finns också en möjlighet att [återställa innehållet](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/products/reset) i produkttabellen.

Är man inloggad som admin på [bloggsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog) ser man admin-navbaren för bloggen och man ser även ej publicerade och borttagna inlägg med en röd statusmarkering. På [adminsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog/admin) för bloggen har man möjlighet att [redigera](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog/edit?id=1) och [ta bort](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog/delete?id=1) blogginlägg genom att klicka på resp. ikon. På redigeringssidan för ett inlägg kan man ändra titel, slug (om man inte vill ha den autogenererade), skriva inlägg i Markdown Extra och välja när inlägget ska publiceras. Utöver Markdown-textfilter används för övrigt också HTML purifier-filter innan texten visas på sajten. Tar man bort ett inlägg så görs endast en “soft delete” och man har möjlighet att återställa ett borttaget inlägg om man råkar ta bort det av misstag. Slutligen kan man också [skapa nya inlägg](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog/create) samt [återställa innehållet](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog/reset) i bloggtabellen i databasen.

Jag har även gjort krav 4 och 5 enligt beskrivning nedan vilket även ger admin-användare möjlighet att redigera innehållet på förstasidan samt se vilka användarkonton som finns skapade.

#### Krav 4
[Förstasidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/) är indelad i fem olika sektioner: “Aktuellt” (featured blogginlägg) som visar ett utvalt blogginlägg. “Veckans erbjudande” som visar ett annat utvalt blogginlägg. “Senaste nytt” som visar de tre senaste publicerade blogginläggen. “Rekommenderade produkter” som visar två utvalda produkter och “Senaste produkter” visar de två produkterna med senast listdatum.

Inloggad som admin kan man uppdatera samtliga sektioner via formuläret på [adminsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/index/edit): Antal inlägg och produkter som visas under varje sektion går att ändra liksom vilka inlägg och produkter som är utvalda. Det går även att ändra rubriken för respektive sektion. Det finns även en möjlighet att [återställa förstasidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/index/reset) till ursprungsläget.

Förstasidan liksom resten av sajten är designad för att vara responsiv och mobilanpassad (antalet sektioner i bredd och storleken på sektionerna ändras när man minskar bredden på fönstret).

#### Krav 5
Användare har möjlighet att [registrera ett nytt konto](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/account/create) via länken som finns på inloggningssidan. Vid registrering får man fylla i önskat användarnamn, lösenord, namn, emejl och om man har en Gravatar kopplad till sin emejl som man vill visa. Användare som skapar konton själva får bara vanliga användarstatus och inte admin-status (vilket sätts med en flagga i tabellen i databasen). Alla lösenord sparas hashade i tabellen i databasen. Via [profilsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/account/edit) som man kommer åt via ikonen uppe till höger i headern har användare möjlighet att ändra sina uppgifter (förutom användarnamnet). Har man fyllt i att man vill använda en Gravatar så visas även denna här. En förskapad vanlig användare med en gravatar finns i form av användaren “bosse” med lösenord “abc123”.

Inloggad som admin kan man via admin-navbaren på profilsidan komma åt [adminsidan](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/account/admin) för att se information om alla skapade användarkonton.

#### Krav 6
I ett [blogginlägg](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/blog?post=tavling) återfinns information om tävlingen med tärningsspelet. Som inloggad användare kan man [spela “Tärningsspel 100”](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/dice100/game) och slår man datorn får man en vinstkod (koden är “plastbit”). Fyller man i koden på [angiven sida](http://www.student.bth.se/~joln17/dbwebb-kurser/oophp/me/kmom10/proj/htdocs/dice100/contest) får man information om vad man har vunnit.

Jag kom inte egentligen inte på några större förändringar att göra av min kod till tärningsspelet från tidigare kursmoment. Några kodrader är dock lite snyggare skrivna. Jag lade också in så man ser sitt användarnamn när man spelar samt jag valde att plocka bort all kod för histogrammet som kändes överflödigt för tävlingsversionen av spelet.

### 2. Projektets genomförande
Eftersom de flesta delar av projektet förekommit i liknande i de tidigare kursmomenten på ett eller annat sätt (i uppgifter eller extrauppgifter) så tyckte jag egentligen inte att det var någon del som var så svår. Jag tycker projektet var mer utmanande tidsmässigt. Att både hitta/skriva content, göra både produktsidor, blogg, förstasida och sedan adminsidor av nästan alla sidor har tagit mycket tid sammanlagt. Jag har dock tyckt att det var ett roligt projekt och därför har jag kanske lagt mer tid på detaljer än vad som var nödvändigt.

Jag tycker det var ett rimligt projekt för kursen men jag hade kanske förväntat mig lite mer objektorienterat fokus. Det känns som det var mer betoning på databasdelen. En idé hade därför kanske varit att ta bort antingen produktdatabasdelen eller bloggdatabasdelen från projektet och istället för att integrera det befintliga tärningsspelet få programmera något nytt objektorienterat spel.

### 3. Om kursen
Jag tycker kursen i stort har hållit samma höga kvalitét som de övriga kurserna i kurspaketet med bra artiklar, videor, övningar och uppgifter. Det har också varit bra feedback i forumet när jag ställt frågor. Feedbacken på de flesta av inlämningsuppgifterna har också varit lite utförligare än i de tidigare kurserna vilket jag uppskattar.

Lite grann har det dock märkts att det var första gången kursen gick i dess v4 version. Kanske främst genom att omfattningen på de olika inlämningsuppgifterna var lite ojämn. Kmom02 var t.ex. väldigt utmanande redan vecka 2 vilket det förvisso sedan kompenserades för med en väldigt liten kmom03. Jag tycker också att fördelningen mellan de olika kursmomenten kan förbättras. Jag hade önskat få lite mer fokus på de objektorienterade delarna i kursen (arv, komposition, interface, traits etc.) med fler exempel, övningar och uppgifter för bättre kunna förstå hur man ska tänka när man ska välja hur man ska skriva sin objektorienterade PHP-kod. Med databas-kursen färskt i minnet tycker jag att man i gengäld kunde ha bantat ner de två databas-kursmomenten till ett.

Det har också varit lite tråkigt att det har varit så få personer som läst kursen i denna perioden. I tidigare kurser tycker jag man lärt sig en hel del på att läsa andra personers frågor i chattar och forum samt ta del av deras redovisningstexter och se hur de har tänkt för att lösa samma uppgifter som man själv löst. Det har jag därför saknat lite i denna kursen.

Jag skulle rekommendera kursen till andra men är det just objektorienterad programmering generellt man vill läsa en första kurs i så hade kanske inte denna kursen varit mitt förstaval eller ens PHP som språk. Dels för att jag som sagt tycker de momenten fick lite för lite fokus i kursen och dels för att OOP i PHP ju lite är en efterhandskonstruktion vilket jag tycker märks i vissa delar. Som avslutande kurs i webprog-kurspaketet tycker jag däremot att den passade bra och jag ger kursen 8/10 i betyg.
