Simple URL Shortener
=============

This is shorturl service, if you know about [bit.ly](http://bit.ly), [goo.gl](http://goo.gl) this project such as this.
##
Technologies used: ﻿PHP, MySQL, JQuery, phpMyAdmin, HTML/CSS, .htaccess rules.

##
Live Demo can be found in [here](http://u.tang.la)

##
Add .htaccess rule if your web server is Apache

```bash
ReWriteEngine on
ReWriteRule ^([a-zA-Z0-9]+)$ index.php?code=$1
```

Add nginx rewrite rule if your web server is Nginx

```bash
location / { 
rewrite ^/([a-zA-Z0-9]+)$ /index.php?code=$1; 
}
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request