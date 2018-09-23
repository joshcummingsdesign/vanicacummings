THIS_FILE := $(lastword $(MAKEFILE_LIST))

all: help

coffee:
	@echo "☕  Making some coffee! ☕"
	@$(MAKE) -f $(THIS_FILE) start
	@$(MAKE) -f $(THIS_FILE) install
	@$(MAKE) -f $(THIS_FILE) deps
	@$(MAKE) -f $(THIS_FILE) build
	@echo "☕  Coffee is ready! ☕"

start:
	@bin/tasks/start.sh

install:
	@bin/tasks/install.sh

deps:
	@bin/tasks/run-deps.sh

remove-lock-files:
	@bin/tasks/remove-lock-files.sh

sync-lock-files:
	@bin/tasks/sync-lock-files.sh

update-deps:
	@$(MAKE) -f $(THIS_FILE) remove-lock-files
	@$(MAKE) -f $(THIS_FILE) deps
	@$(MAKE) -f $(THIS_FILE) sync-lock-files

check-deps:
	@bin/tasks/check-deps.sh

build-project:
	@bin/tasks/build-project.sh

build:
	@$(MAKE) -f $(THIS_FILE) check-deps
	@$(MAKE) -f $(THIS_FILE) build-project

build-prod:
	@bin/tasks/build-prod.sh

watch:
	@bin/tasks/watch.sh

test:
	@bin/tasks/test.sh

sync:
	@bin/tasks/sync.sh

sbw:
	@$(MAKE) -f $(THIS_FILE) sync
	@$(MAKE) -f $(THIS_FILE) build
	@$(MAKE) -f $(THIS_FILE) watch

dev:
	@bin/tasks/dev.sh

ssh:
	@bin/tasks/ssh.sh

ssh-dev:
	@bin/tasks/ssh-dev.sh

clone-dev:
	@bin/tasks/clone-dev.sh

rebuild:
	@bin/tasks/rebuild.sh

stop:
	@bin/tasks/stop.sh

restart:
	@bin/tasks/restart.sh

clean:
	@bin/tasks/clean.sh

help:
	@echo "Welcome to Grizzly WP!"
	@echo "	make coffee"
	@echo "		- Run start, install, deps, and build"
	@echo "	make start"
	@echo "		- Start the containers"
	@echo "	make install"
	@echo "		- Install WordPress inside the container"
	@echo "	make deps"
	@echo "		- Install project dependencies"
	@echo "	make dev"
	@echo "		- Connect dev branch to dev server"
	@echo "	make update-deps"
	@echo "		- Update newly-added dependencies and generate lock files"
	@echo "	make build"
	@echo "		- Build the project"
	@echo "	make build-prod"
	@echo "		- Build the project with the production flag"
	@echo "	make watch"
	@echo "		- Serve the site on port 3000 and watch for changes"
	@echo "	make test"
	@echo "		- Run all tests excluding acceptance tests"
	@echo "	make sync"
	@echo "		- Copy your www folder into the container"
	@echo "	make sbw"
	@echo "		- Sync, Build, Watch"
	@echo "	make ssh"
	@echo "		- SSH into the container"
	@echo "	make ssh-dev"
	@echo "		- SSH into the dev server"
	@echo "	make clone-dev"
	@echo "		- Clone the dev server to local"
	@echo "	make rebuild"
	@echo "		- Rebuild and restart the container"
	@echo "	make stop"
	@echo "		- Stop the container"
	@echo "	make restart"
	@echo "		- Restart the container"
	@echo "	make clean"
	@echo "		- Docker garbage collection"

.PHONY: coffee start install run-deps build-project check-deps remove-lock-files sync-lock-files build build-prod watch test sync dev ssh ssh-dev clone-dev rebuild stop restart clean
