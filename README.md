# ujianonline
Ujian online web based

Aplikasi Ujian online smk berbasis web

## Built With
* php7
* mysql
* Jquery
* bootstrap
* AdminLTE

### Installing

clone the repository

```
git clone https://github.com/mqnoy/ujianonline.git
```

import database

[db_ujianonline.sql](https://raw.githubusercontent.com/mqnoy/ujianonline/master/db_ujianonline.sql) 
```
mysql -u yourusername -p db_ujianonline < db_ujianonline.sql
```

Test

```
Admin user
open url in your browser http://host/ujianonline/admin.php
username : admin
password : admin

Siswa
open url in your browser http://host/ujianonline/siswa.php
Nis : first time login is register ,next time just login with existing record in database 
Nama : same as Nis
```


## Demo

```
Admin user
http://kelompok3nih.tk/ujianonline/admin.php
username : admin
password : admin

Siswa
http://kelompok3nih.tk/ujianonline/siswa.php
Nis : your nis ex : 12345678
Nama : yourname
```


## Author
* kelompok - [kelompok3](http://kelompok3nih.tk)

## License

This project is licensed under the Apache-2.0 - see the [LICENSE.md](LICENSE) file for details