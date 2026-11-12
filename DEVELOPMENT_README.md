# Development using a virtual machine

> ## End-of-Life occurred 28 Sep 2016
>
> This project is no longer maintained, and reached its end of life on 28 Sep
> 2016; the last public release was 1.12.20.
>
> At this time, the repository has been archived, and is read-only.

You can set up a development virtual machine for ZF1 unit testing and library 
development following these simple instructions.

### 1. Install requirements for VM. (Note: these are not required by ZF1 itself)

- VirtualBox (https://www.virtualbox.org/)
- Ruby (http://www.ruby-lang.org/)
- Vagrant (http://vagrantup.com/)

### 2. Checkout repository to any location

    git clone git://github.com/zendframework/zf1.git zf1-dev
    cd zf1-dev

### 3. Start the process by running Vagrant.

    vagrant up

This will take a long while as it has to download a VM image and then 
provision it. Once it has finished, it will exit and leave you back at the
command prompt.

### 4. SSH into the VM

    vagrant ssh

### 5. Build a version of PHP.

    php-build.sh 5.3.11

This also takes a while as it compiles PHP for you!
   
### 6. Select PHP to use:

    pe 5.3.11

### 7. Run tests

    cd /vagrant/tests
    phpunit --stderr -d memory_limit=-1 Zend/Acl/AclTest.php
    phpunit --stderr -d memory_limit=-1 Zend/Amf/AllTests.php
    (etc...)

Note that you can repeat items 5 and 6 to create any version if PHP.

## Notes:

- The VM will be running in the background as VBoxHeadless
- HTTP and SSH ports on the VM are forwarded to localhost (22 -> 2222, 80 -> 8081)
- The zf1-dev directory you checked out will be mounted inside the VM at /vagrant
- You can develop by editing the files you cloned in the IDE of you choice.

To stop the VM do one of the following:

    vagrant suspend   # if you plan on running it later
    vagrant halt      # if you wish to turn off the VM, but keep it around
    vagrant destroy   # if you wish to delete the VM completely
    
Also, when any of of the Puppet manifests change (.pp files), it is a good idea to rerun them:

    vagrant provision

# Releasing a new version

A release is one commit named `Release x.y.z` on its own branch (`release/x.y.z`), merged with a pull request.

### 1. Prepare the release commit

- `CHANGELOG.md`: rename the `[Unreleased]` section to `[x.y.z] - YYYY-MM-DD` and add a new, empty `[Unreleased]` section above it.
- `composer.json`: set `version` to `x.y.z`.
- `library/Zend/Version.php`: set `Zend_Version::VERSION` to `x.y.z`.
- `composer.lock`: run `composer update --lock`, so that the content hash matches the changed `composer.json`. No package version may change with it.

  If the command fails because a requirement of `phpcompatibility/php-compatibility` (installed from its development branch) has changed, update that package together with PHP_CodeSniffer:

      composer update -W phpcompatibility/php-compatibility squizlabs/php_codesniffer

- `README.md`: update the supported PHP versions and the known issues when they change with the release.

Changes that break backward compatibility are described in `BREAKING-CHANGES.md` by the pull requests that make them; check that the section of the release is complete.

### 2. Merge and tag

- Wait for all workflows (PHPUnit, PHPStan, PHPCS, PHP-CS-Fixer, Rector, Standalone load, Database drivers) to pass and merge the pull request.
- Tag the merge commit as `release-x.y.z` and push the tag.
- Publish the GitHub release for the tag with the section of `CHANGELOG.md` as its notes.
