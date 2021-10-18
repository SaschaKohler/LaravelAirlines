
#Laravel 
###getting used to it


#Tasks

#Laravel Setup
1.   Laravel 8.x in einem Docker-Environment aufsetzen, Laravel Sail ist ausreichend - kann aber auch gerne ein eigenes Setup sein.
- habe mich für laravel-sail entschieden / docker images entsprechend local installiert


2. Eloquent Model
   Aus dieser Rest-Api wollen wir Airlines in unsere Datenbank speichern: https://api.instantwebtools.net/v1/airlines
   Bitte dafür ein passendes Model+Migration erstellen und per Seeder die Daten in die DB importieren.

### Already Done 
- Migration für airline_table erstellt -> mysql liegt im DockerImage als datenbank
- default migration behalten und ebenfalls in daten bank angelegt erstellt
- den seeder mit den daten aus der api befüllt
- cave -> sehr inkonsistenter Datensatz daher im seeder nur daten gelesen die mindestens 8 Datenpunkte aufweisen
- api im seeder requested (guzzle http). id autoincrement da datensätze teilweise ohne id 



#STILL TO DO
3. Rest API
   In der Rest API wollen wir Airlines anzeigen, eintragen und updaten

- POST /api/airline sollte eine neue Airline erstellen
- GET /api/airlines soll alle Airlines ausgeben
- GET /api/airlines/:id soll die Airline mit der :id ausgeben
- PUT /api/airlines/:id soll den Namen der Airline mit der :id updaten

4. Pagination
   In einem anderen Endpunkt der API können wir uns Passagiere zu den Airlines holen, diese sind jedoch paginated.
   Ziel hier ist es, die Passagiere auszulesen und bei page=1 die ersten 50, bei page=2 die zweiten 50 etc. auszugeben. Die Passagiere müssen nicht gespeichert werden, und sollen bei jedem Request neu ausgelesen werden.

Endpunkt: https://api.instantwebtools.net/v1/passenger?page=0&size=10
Docs: https://www.instantwebtools.net/fake-rest-api#read-passenger-paginated

GET /api/passengers/:airline_id?page=1
