# Football League Management System

Laravel alkalmazás a futballliga mérkőzéseinek és csapatainak kezeléséhez SQLite adatbázissal.

## Projekt Leírása

Ez a Laravel projekt egy futballliga kezelő rendszert valósít meg. Lehetővé teszi:

- **Csapatok kezelése**: Csapatok CRUD operációi (Create, Read, Update, Delete)
- **Meccsek kezelése**: Új meccses hozzáadása, pontszámok és meccs állapotának módosítása

## Telepítés

### Előfeltételek
- PHP 8.1+
- Composer

### Lépések

1. Függőségek telepítése:
```bash
composer install
```

2. Konfigurációs fájl másolása:
```bash
cp .env.example .env
```

3. Alkalmazáskulcs generálása:
```bash
php artisan key:generate
```

4. Migrációk futtatása:
```bash
php artisan migrate
```

5. Adatok betöltése (seeder):
```bash
php artisan db:seed
```

6. Fejlesztői szerver indítása:
```bash
php artisan serve
```

## API Végpontok

### Teams (Csapatok)

| Metódus | Végpont | Leírás |
|---------|---------|--------|
| GET | `/api/teams` | Összes csapat listázása |
| POST | `/api/teams` | Új csapat hozzáadása |
| GET | `/api/teams/{id}` | Adott csapat adatai |
| PUT/PATCH | `/api/teams/{id}` | Csapat módosítása |
| DELETE | `/api/teams/{id}` | Csapat törlése |

### Games (Meccsek)

| Metódus | Végpont | Leírás |
|---------|---------|--------|
| GET | `/api/games` | Összes meccs listázása |
| POST | `/api/games` | Új meccs hozzáadása |
| GET | `/api/games/{id}` | Adott meccs adatai |
| PUT/PATCH | `/api/games/{id}` | Meccs módosítása (pontok, állapot, idő) |
| DELETE | `/api/games/{id}` | Meccs törlése |

## API Használat Példák

### Új csapat hozzáadása
```bash
curl -X POST http://localhost:8000/api/teams \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Manchester City",
    "tournament": "Premier League"
  }'
```

### Új meccs hozzáadása
```bash
curl -X POST http://localhost:8000/api/games \
  -H "Content-Type: application/json" \
  -d '{
    "home_team_id": 1,
    "away_team_id": 2,
    "scheduled_at": "2026-03-15 15:00:00"
  }'
```

### Meccs frissítése (pontok és állapot)
```bash
curl -X PUT http://localhost:8000/api/games/1 \
  -H "Content-Type: application/json" \
  -d '{
    "home_score": 2,
    "away_score": 1,
    "current_period": "second_half"
  }'
```

## Adatbázis Struktúra

### Teams tábla
- `id`: Azonosító (Primary Key)
- `name`: Csapat neve
- `tournament`: Verseny/Liga neve
- `created_at`: Létrehozás dátuma
- `updated_at`: Módosítás dátuma

### Games tábla
- `id`: Azonosító (Primary Key)
- `home_team_id`: Hazai csapat (Foreign Key)
- `away_team_id`: Vendég csapat (Foreign Key)
- `home_score`: Hazai csapat pontjai (alapértelmezés: 0)
- `away_score`: Vendég csapat pontjai (alapértelmezés: 0)
- `current_period`: Meccs állapota (not_started, first_half, second_half, finished)
- `scheduled_at`: Tervezett kezdés ideje
- `created_at`: Létrehozás dátuma
- `updated_at`: Módosítás dátuma

## Meccs Állapotok

- `not_started`: A meccs még nem kezdődött el
- `first_half`: Az első félidő folyamatban van
- `second_half`: A második félidő folyamatban van
- `finished`: A meccs befejeződött

## Modellek

### Team Model
Relációk:
- `homeGames()`: Hazai meccsek
- `awayGames()`: Vendég meccsek

### Game Model
Relációk:
- `homeTeam()`: Hazai csapat adatai
- `awayTeam()`: Vendég csapat adatai

## Fejlesztés

### Szerver indítása debug módban
```bash
php artisan serve
```

### Adatbázis visszaállítása
```bash
php artisan migrate:refresh --seed
```

### Seeder futtatása
```bash
php artisan db:seed
```

## Adatbázis Info

- Az adatbázis SQLite-ot használ (database/database.sqlite)
- 98 csapat van előtöltve az ötödik nagy európai ligaból (Premier League, Bundesliga, Ligue 1, LaLiga, Serie A)
