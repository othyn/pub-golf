# pub-golf
Basic web app for pub golf games

In it's current state, the project isn't designed to be fully secure - in the meaning that, if you are lucky enough to guess both a game code and username, you can play as another user. Requests are validated so that users cannot easily stray outside of the scope of a game, but I'm not too fussed if they stumble across another game code randomly and create a user onto it. It's only meant to be a silly side project which serves its purpose enough, using obscurity with a high degree of randomness at this point is fine. I'll start to look at a user system (laravel's auth handler) as a possible expansion, which can bring other benefits such as game history, manage saved games, etc. but it's not necessary. Simple user in session; user remembers the game code and name to re-join should be fine for the scope & role of the project.

## Setup
The project runs using a self contained instance of Homestead, mainly for multiplatform support and hey, I like vagrant. [Instructions on installation and setup](https://laravel.com/docs/5.6/homestead), and more specifically the [per-project installation](https://laravel.com/docs/5.6/homestead#per-project-installation) are on Laravel's website, although I'll cover the step-by-step process below for getting this up and running for this project. I'm also using this as an excuse to explore [Bulma](https://bulma.io/), as it looks like a fun, lightweight and stylish CSS framework. For the initial version, just to get a PoC going, its just raw JS/jQuery - although I plan to migrate this to Vue and look into a socket/event based API.

### Dev Dependancies
These are the underlying requirements of the system in order to develop for the project. If on Windows, I'd install [git bash](https://git-scm.com/download/win), it's nice to have a familiar bash shell present and it will make certain things easier later on.

0. Install a hypervisor: [VirtualBox](https://www.virtualbox.org/wiki/Downloads) (recommended), [Parallels](https://www.parallels.com/products/desktop/), [Hyper-V](https://docs.microsoft.com/en-us/virtualization/hyper-v-on-windows/quick-start/enable-hyper-v) or [VMWare](https://www.vmware.com/). The steps below assume VirtualBox, as that tends to be what I use on workstations. Hyper-V for that homelab tho

1. Install [Vagrant](https://www.vagrantup.com/downloads.html), check this is installed by running `vagrant -v` in your console window. This should print out the version number for the installed version of Vagrant, something like `Vagrant 2.0.1`

At this point, if on Windows, I'd install [git bash](https://git-scm.com/download/win), it's nice to have a familiar interface present (Bash) and it will make certain things easier later on. If not, PowerShell will do fine

2. Install [PHP 7](http://windows.php.net/download/) ([non-thread safe version](http://stackoverflow.com/questions/1623914/what-is-thread-safe-or-non-thread-safe-in-php)) if you are on Windows (`C:\PHP7` is nice and easy), macOS should be sorted already - although this can be installed/updated through [Homebrew](https://brew.sh/) as well (see below). Linux is an easy install via your distros package manager (although you may need to add a source). Check this is installed by running `php -v` in your console, this should print out the version number for the installed version of PHP in the same manner Vagrant did

3. Install [Composer](https://getcomposer.org/download/) (self installer works a treat for Windows), I highly recommend [Homebrew](https://brew.sh/) for this on macOS (`$ brew update` then `$ brew tap homebrew/homebrew-php` finally `$ brew install composer`). Check this is installed by running `composer -V` in your console, this should print out the version number for the installed version of Composer in the same manner Vagrant and PHP did

[Here is a really helpful tutorial to install PHP 7 and Composer on Windows 10](http://kizu514.com/blog/install-php7-and-composer-on-windows-10/), although I'd recommend skipping the part about installing Composer manually and just use the auto-installer linked above. Seriously, saved a load of hassle and time. It's great to understand these things, but sometimes - wheel - reinvent - nah.

4. Install [Node & NPM](https://nodejs.org/en/download/), again I'd recommend just using the installer for your system. Alternatively, on macOS you could use homebrew (via a source being added) and on Linux, by your distros package manager - although you may also need to a source depending on the distro. Check this is installed by running `node -v` & `npm -v` in your console, this should print out the version number for the installed version of Node & NPM in the same manner Vagrant, PHP and Composer did

5. You may need to install [Yarn](https://yarnpkg.com/en/), for use when webpack/mix is building the assets. I did on a fresh macOS 10.13 install, in which you can run `brew install yarn --without-node` (as Node is already installed) in a console window. Instructions are on Yarn's site on [how to do this for your OS](https://yarnpkg.com/en/docs/install). Check this is installed by running `yarn -v` in your console, this should print out the version number for the installed version of Yarn in the same manner Vagrant, PHP, Composer, Node & NPM did. Consistency is nice

### Environment
These are the requirements for the project specifically, installing software dependacies for Laravel and setting up Homestead for use with Vagrant.

0. `cd` into the project, wherever you cloned it, as all of the below will need to be executed from within it.

1. Run `composer install` to install the required project dependacies, this may take a while...

2. Run `npm install` to install the required project dependacies, this again may take a while...

3. Run `php vendor/bin/homestead make` if you are on macOS or Linux, `vendor\\bin\\homestead make` if you are on Windows to get Homestead installed and ready for use with Vagrant

4. Check that you have a key pair setup for Homestead, this defaults to `id_rsa`. To check this, `ls -la ~/.ssh` and see if the keys are present. If not `ssh-keygen -t rsa` will generate you the key pair - or you can modify the `homestead.yaml` config to use a different key pair. On Windows, use git bash as admin to run the commands listed.

5. Other modifications to the `homestead.yaml` config I'd recommend is changing the memory used to something more suiting of this small projects nature, I'd recommend something in the region of 512mb to 1024mb. The only other thing that you should need to change is the `sites` `map`, so the site is hosted at `pub-golf.test`

6. You'll need to modify your hosts file to map `pub-golf.test` to the IP address specified in your `homestead.yaml` config

7. Now to setup Laravel's `.env`, `cp .env.example .env`, that will create the `.env` file that Laravel will run off. You'll then need to run `php artisan key:generate` otherwise you'll just be staring at Laravel's default error screen

## Development

0. Run `vagrant up` in your console, that should bring up the vagrant box. If it's the first time installing, it will need to download the vagrant box which may take some time, but it will show the progress of this as part of the startup proceedure. After it's finished launching (hopefully successfully), you can navigate to `pub-golf.test` in your browser and huzza - one live local site!

1. Any changes to the server application will be mirrored immediately to the vagrant box, so give the browser a refresh after changes and your golden

2. Just updated client content? [Laravel Mix](https://laravel.com/docs/5.6/mix), a nice layer ontop of webpack config, will build the Sass and JS with a quick run of `npm run dev` or automatically with `npm run watch`
