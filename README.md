# Shtem <a href="https://codeclimate.com/github/p4kl0nc4t/shtem/maintainability"><img src="https://api.codeclimate.com/v1/badges/81e7d508cab2e5ce57b9/maintainability" /></a>
Shtem is a PHP based application which serves its function as a "short term memory". It means that Shtem will be accepting a "memory" input in form of HTTP request and then saves it inside the server for a short period of time.
### What are the intended use cases?
There is actually no "intended" use case. Shtem could be used in a variety of functions. For example, Shtem could be used when performing a RCE exploitation where the output must be reflected to a remote server. It is very useful when you don't have a server connected to the internet.
### How to use it?
After you have deployed Shtem, you could use it by contacting its API endpoint from a script or by contacting it directly from a web browser. A hosted version of Shtem is available [here](https://lcat.dev/shtem) (please note that there is no uptime guarantee).
## Installation
### Prequisites
Shtem requires a web server that supports PHP (e.g. Apache, Nginx, etc.). In some cases, PHP Development Server could also be used in development environment. For servers other than Apache, you may need to create an additional file equivalent to the `.htaccess` file.
### Configuration
Shtem configuration could be done by editing `config.php` file. In some cases, `base_uri` is the only thing that needs to be changed. If you're going to use Apache, make sure that the usage of `.htaccess` is allowed.
### Deployment
In an Apache web server, you just need to copy all of the files into the web directory. For use with PHP Development Server, use `router.php` as a router by running `php -S host:port router.php` command.
## API Documentation
All of these endpoints will respond in JSON format.

Endpoint | Method | Description | Example
--- | --- | --- | ---
/`<mname>` | GET/POST | Store a memory item named `<mname>`. A valid `<mname>` consists of lowercase and numerics (a-z0-9). It is not necessary to set `<mname>`. If `<mname>` is not set, the default value is the remote or the IP address. For example, if the remote address is `192.168.1.1` then the `<mname>` will be `19216811`. | `/foo`, `/bar`, `/baz`
/get/`<mname>` | GET | Get a memory item named `<mname>` if it exists. | `/get/foo`, `/get/bar`, `/get/baz`

## Contribution
I am new to PHP development, can't guarantee that everything works flawlessly. Feel free to open a pull request or an issue. Any kind of contribution is highly appreciated.
## License
Shtem is licensed with MIT License.
