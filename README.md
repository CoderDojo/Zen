### CoderDojo Zen
Initially a basic Dojo listing manager. We plan to enhance and add features down 
the line. You can help us make it better by forking this project, adding stuff and then issuing
a pull request back to us!

### Some things to add/hack/dream about
- User settings
- Improved admin panel
- Improved overall Dojo list w/ search
- Mutliple admins on a Dojo
- If country == US, have states also.

### Zen is built on and uses: 
- CodeIgniter http://codeigniter.com/
- Tank Auth http://www.konyukhov.com/soft/tank_auth/
- Twitter Bootstrap http://twitter.github.com/bootstrap/

### Local deployment notes 
- Create a MySQL database:
  - install mysql-server 
  - create a database
    - sudo mysqladmin create dojozen
  - create a user (choose a password different than '1234')
    - echo "grant all privileges on dojozen.* to 'dojozen'@'localhost' identified by '1234'" | sudo mysql dojozen
  - create an empty database
    - mysql dojozen --user=dojozen -p < schema.sql
  - fill in the details in  `'/application/config/development/database.php'`. 
- enter an encryption key in `'/application/config/development/config.php'` on line 227
- Configure a webserver
  - install apache (sometimes known as 'httpd')
  - add a new configuration file at /etc/httpd/sites-available/zen.conf . We'll have it listen on port :81

```
    Listen 81
    <VirtualHost *:81>
      <Directory /home/arnouten/dev/Zen>
        AllowOverride All
        Require all granted
      </Directory>
      DocumentRoot /home/arnouten/dev/Zen
    <VirtualHost>
```

  - ln -s /etc/httpd/sites-available/zen.conf /etc/httpd/sites-enabled/zen.conf
  - Note `.htaccess` is used to mask the `'index.php'` part of the URL, depending on your set up, you may need to edit this. 
