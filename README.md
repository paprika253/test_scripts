# Test

## Preparing

To install npm packages and migrate tables in scripts:

``` bash
$ main install
```
## Usage

Slaves: first, second, third

To call one of the scripts type:

``` bash
{slave}_message, {slave}_perm, {slave}_command
```

To run websocket server and router (API imitation):

``` bash
$ make first_socket
```

And in second terminal:

``` bash
$ make first_server
```