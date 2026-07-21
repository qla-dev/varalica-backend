# Varalica backend

Minimalni Laravel 12 backend za sadržaj pet implementiranih Varalica igara.

## Tabele

| Igra | Kategorije | Sadržaj |
| --- | --- | --- |
| Pronađi Varalicu | `impostor_categories` | `impostor_words` |
| Istina ili Izazov | `truth_dare_categories` | `truth_dare_questions` |
| Šta bi Radije | `rather_categories` | `rather_questions` |
| Dva Srca | `dva_srca_categories` | `dva_srca_questions` |
| Pogodi Pojam | `guess_word_categories` | `guess_word_words` |

Svaka sadržajna tabela ima obavezni strani ključ prema svojoj kategorijskoj tabeli i `ON DELETE CASCADE`.

## Lokalno pokretanje

```bash
composer install
php artisan migrate:fresh --seed
php artisan test
```

Seederi dodaju 20 kategorija i 200 dječiji-prihvatljivih sadržaja za svaku igru.
