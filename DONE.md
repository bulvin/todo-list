# DONE - Podsumowanie projektu To-Do List

## Co zostało zrobione

1. **Implementacja CRUD zadań**
    - Możliwość tworzenia, edytowania, wyświetlania i usuwania zadań.
    - Zadania mają pola: nazwa, opis, priorytet, status, termin wykonania.
    - Walidacja danych na poziomie formularzy i backendu.

2. **Filtrowanie zadań**
    - Lista zadań może być filtrowana według priorytetu, statusu oraz terminu.
    - Zadania można filtrować po terminie wykonania (np. 'przeterminowane', dzisiejsze, przyszłe).

3. **Powiadomienia e-mail**
    - System wysyła powiadomienia e-mail na 1 dzień przed terminem zadania.
    - Użyto kolejek i schedulera Laravela do realizacji tego zadania.

4. **Obsługa wielu użytkowników**
    - System uwierzytelniania Laravela zapewnia możliwość rejestracji, logowania.
    - Każdy użytkownik widzi i zarządza tylko swoimi zadaniami.

5. **Udostępnianie zadań przez link z tokenem**
    - Możliwość generowania publicznych linków do zadań, które wygasają po określonym czasie - użytkownik podaje ilość dni po której link wygaśnie.
    - Nieautoryzowani użytkownicy mogą przeglądać zadania poprzez te linki, ale nie mogą ich edytować ani usuwać.

6. **Migracje i seedery**
    - Baza danych skonfigurowana przy pomocy migracji i wypełniona przykładowymi danymi.

7. **Frontend**
    - Interfejs użytkownika stworzony w Laravel Blade.
    - Użyto Tailwind CSS do stylizacji.

---

## Przemyślenia i wnioski

- Projekt pozwolił mi pogłębić znajomość Laravel 11 i wykorzystać tailwinda,
- Strukturę projektu utrzymywałem ze standardem laravel (MVC).
- SQLite dobry dla prostoty setupu,
- dodałbym pełną historię zmian zadań oraz integrację z Google Calendar.
- Problem z bazą testową: RefreshDatabase czyścił bazę deweloperską zamiast testowej - rozwiązane przez poprawną konfigurację .env.testing

---

