OS := $(shell uname)

start_dev:
ifeq ($(OS),Darwin)
	docker volume create --name=app-sync
	docker-compose -f docker/docker-compose-dev.yml up -d
	docker-sync start
else
	docker-compose up -d
endif

stop_dev:           ## Stop the Docker containers
ifeq ($(OS),Darwin)
	docker-compose -f docker/docker-compose-dev.yml stop
	docker-sync stop
else
	docker-compose stop
endif
