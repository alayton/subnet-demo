
# Demo subnets project

Running the application
-----

Initial setup:
```bash
$ docker-compose up
```

This will bring up all of the containers and install composer and npm packages. Composer is helpful and will print messages as it runs; when the following message is printed, the PHP container is functioning.
```
sf4_php   | [15-May-2020 03:14:25] NOTICE: ready to handle connections
```

To finish preparing the backend, the example subnet data needs to be inserted. This is done with a Symfony command. While npm is still installing, the following command can be run in a separate terminal:
```
docker exec -it sf4_php bin/console subnets:insert
```

NPM being npm, it'll still be running quietly for several more minutes. Eventually, it will start printing things to show progress again, and once it stops and reports compiling successfully, the full app will be running and accessible at http://localhost:4200

Access
------
Symfony endpoint: http://localhost:82/subnets

Frontend: http://localhost:4200

Misc
-----
I've included a log of my thought process throughout the challenge [here](devlog.md).
