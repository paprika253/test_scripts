install:
	@cd main/ && npm i
	@cp main/.env.example .env
	@php first_slave/migration.php
	@php second_slave/migration.php
	@php third_slave/migration.php
	@cd main/ && npm migration.js

first_socket:
	@php -f first_slave/index.php

first_server:
	@php -S 127.0.0.1:8000 first_slave/server.php

second_socket:
	@php -f second_slave/index.php

second_server:
	@php -S 127.0.0.1:8080 second_slave/server.php

third_socket:
	@php -f third_slave/index.php

third_server:
	@php -S 127.0.0.1:8081 third_slave/server.php