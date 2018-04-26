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

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
