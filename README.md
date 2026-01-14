# Online škola jezika – Laravel aplikacija

Ovaj projekat predstavlja web aplikaciju za online školu jezika, razvijenu u Laravel framework-u.  
Aplikacija podržava različite uloge korisnika (admin, teacher, student), upravljanje kursevima, zakazivanje časova i rezervacije, uz primenu politika pristupa, testova i CI procesa.

---

## 🛠 Korišćene tehnologije

- **Laravel 12**
- **PHP 8.2**
- **MySQL** (razvoj) / **SQLite** (testovi)
- **Laravel Breeze** (autentifikacija)
- **Blade + Tailwind CSS**
- **Laravel Pint** (code style)
- **PHPUnit** (feature i unit testovi)
- **GitHub Actions** (CI)

---

## 👥 Uloge u sistemu

### Admin
- Upravljanje kursevima (CRUD)
- Pristup admin panelu

### Teacher
- Kreiranje i upravljanje terminima časova (lesson sessions)
- Pregled samo sopstvenih termina
- Zaštita pristupa putem Policy mehanizma

### Student
- Pregled dostupnih časova
- Rezervacija (booking) termina
- Otkazivanje sopstvenih rezervacija

---

## 🧩 Arhitektura aplikacije

- **MVC arhitektura**
- Odvojeni kontroleri po ulogama:
  - `Admin\CourseController`
  - `Teacher\LessonSessionController`
  - `Student\BookingController`
- **Policy** klasa za kontrolu pristupa nad `LessonSession`
- **Middleware** za role-based autorizaciju
- Eloquent relacije između modela:
  - Course → LessonSession
  - LessonSession → Booking
  - User → (teacher / student)

---

## 🔐 Autorizacija i bezbednost

- Laravel Breeze autentifikacija
- Middleware za proveru uloge korisnika
- Policy za fine-grained kontrolu (teacher vidi samo svoje sesije)
- Zabranjen pristup neovlašćenim rutama (403)

---

## 🧪 Testiranje

Aplikacija sadrži **feature i unit testove**, uključujući:

- Admin pristup admin rutama
- Student nema pristup admin/teacher rutama
- Teacher vidi samo svoje časove
- Student booking flow (rezervacija, duplikat, otkazivanje)
- Auth testove (login, logout, registracija)

Pokretanje testova lokalno:

```bash
php artisan test
