@echo off
C:\xampp\xampp_start
C:\xampp\mysql\bin\mysql -u root -e "DROP DATABASE IF EXISTS foodapp
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE IF NOT EXISTS foodapp
C:\xampp\mysql\bin\mysql -u root foodapp < .\FinalPAW2021\sql\AllTables.sql
cd FinalPAW2021
START http://localhost:8889
php -S localhost:8889
