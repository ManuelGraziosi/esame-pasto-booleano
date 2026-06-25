# Pasto Booleano - Full Stack Recipe Manager (Backoffice Laravel API per la gestione delle ricette)

## Descrizione

Applicazione web full stack per la gestione di ricette, ingredienti e allergeni, con sistema di autenticazione, autorizzazione e funzionalità avanzate lato utente.
Il sistema permette la gestione completa con operazioni CRUD. Incluisce relazioni 1-N e N-N, upload di media e autenticazione via Laravel Breeze.

## Tech Stack

- Laravel
- Blade
- PHP
- JavaScript
- npm

---

## Autenticazione e Autorizzazione

- Sistema di login/registrazione utenti
- Gestione ruoli (admin / user)
- Accesso controllato alle operazioni CRUD
    - Solo utenti autenticati possono creare/modificare
    - Solo admin possono eliminare

---

## Funzionalità Principali

### Gestione Ricette

- CRUD completo ricette
- Upload immagini
- Associazione ingredienti (many-to-many)
- Filtri avanzati
- Calcolo automatico calorie totali
- Calcolo automatico degli allergeni
- Visualizzazione dettagli di ricette con informazioni collegate

### Gestione Ingredienti

- CRUD completo
- Relazioni multiple con allergeni
- Filtri avanzati
- Visualizzazione dettagli ingrediente con informazioni collegate

### Gestione Allergeni

- CRUD completo
- Upload immagini
- Visualizzazione dettagli allergene ( possibile collegare informazioni)

### Filtri e Ricerca

- Filtro per:
    - allergeni
    - ingredienti
    - range calorico
    - ricerca testuale

### Autenticazione

- Registrazione, autenticazione e autorizzazione per admin e user

---

## Setup e Installazione

```bash
npm install per installare le dipendenze del frontend
php artisan migrate per eseguire le migrazioni del database
php artisan db:seed per popolare il database con dati di esempio
```
