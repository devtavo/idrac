# REST API with javascript client code samples

Lyra REST API code examples using [our PHP SDK](https://github.com/lyra/rest-php-sdk).

## Configure your keys

All authentication information are defined in [keys.php](https://github.com/lyra/rest-php-examples/blob/master/www/keys.php).
You can use the already defined demo keys or update it with yours.

## Available examples

Available examples: see index.html

## Try it with docker

To run our examples using docker, you first need to install:

* [docker engine](https://docs.docker.com/engine/installation/) 
* and [docker-compose](https://docs.docker.com/compose/install/)

Start the container:

    docker-compose up -d

and go to http://localhost:6980

## Try it using your favorite web-server

Copy src/ directory content to your PHP server, and go to *index.html* page.

## Try it on Heroku

You can easily install our examples on Heroku for free. First you need:

- a valid account, see https://www.heroku.com
- keroky cli installed locally: https://devcenter.heroku.com/articles/getting-started-with-php#set-up

Next, to deploy php examples, do:

- heroku create
- git subtree push --prefix www heroku master

Start the container and open it in your web-browser:

- heroku ps:scale web=1
- heroku open

If you do some updates and you want to publish it, do:

- git commit -am"some updates"
- git push heroku master
- heroku open

and see your changes on the web-browser.