## GET API FROM TMDBMOVIES

## COMMAND TO GET DATA FROM API TMDB



```bash
php artisan app:get-data-t-m-b-d
```
ITS ONE COMMAND BUT CONNECT WITH ANOTHER:
```bash
'fetch-movies'
'fetch-series'
'fetch-genres'
'fetch-translations'
```

## ENDPOINTS

```laravel
/movie/{movie}
retrieves the movie with the ID, retrieves the data from the DB and displays the values.

/movie
displays all movies from the DB with paging.

/movie/show/pl
displays all movies from the database with PL language translation.

/movie/show/de
shows all movies from the database with DE translation.


/serie
 shows all series from the database.

/serie/{serie}
retrieves series by ID, retrieves data from the database and displays values

/serie/display/pl 
displays all series from the database and translates them into PL.

/serie/show/de
displays all series from the database with translation into DE.


/genre
displays all genres from the database with pagination.

/genre/{genre} 
retrieves the genre by id, retrieves data from the db and displays values.

/genre/show/pl 
displays all genres from the database, with PL language translation.

/genre/show/de
displays all genres from the database, translated into DE.

```

## License

[MIT](https://choosealicense.com/licenses/mit/)
