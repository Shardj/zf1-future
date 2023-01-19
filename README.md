# Attention

This is the new package we use for the fde project since php 8 update for zend framework.
We have pulled a fork from the original repository: https://github.com/Shardj/zf1-future

Our fork is located in Github: https://github.com/fgrp-fde/zf1-future

We imported the forked repo into Gitlab: https://gitlab-next.fgrp.net/ext/zf1-future

By using repository mirroring, all changes in Gitlab are also transferred to the fork on Github.

If there are changes in the original repo that we also want to have in our project, this is how it works:

* Sync the changes within the Github project (https://github.com/fgrp-fde/zf1-future) from the original project

* In the GITLAB project, run the following locally:
  * Set your upstream to the repository you forked from: 
   ```bash
  git remote add upstream git@github.com:fgrp-fde/zf1-future.git
  ```
   * Then fetch all the branches including master from the original repository: 
  ```bash
  git fetch upstream
  ```
  * Merge this data in your local master branch:
  ```bash
  git merge upstream/master
   ```
  * Push the changes to your repository i.e. to origin/master:
  ```bash
  git push origin master
   ```


![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>
# Zend Framework 1 now for PHP 8.1!
### Classic ZF1 Reborn
Zend may have abandoned the original Zend Framework, but the global Zend Framework Community has not! Since Zend sentenced ZF1 to EOL, the Zend Framework community around the globe has continued to work and build on what we consider to be one of the best PHP frameworks of all time.

# ZF1-Future Sponsors
### Products and Projects built with ZF1-Future:

<a href="https://webtigers.com"><img src="https://webtigers.s3.amazonaws.com/logos/Logo-New-1-Dark.png" width="50%" /></a>

Creators of the [Tiger Development Platform](https://webtigers.com) featuring ZF1-Future

<a href="https://seidengroup.com"><img src="https://www.seidengroup.com/wp-content/uploads/2017/03/SeidenLogo-180.png" alt="Seiden Group: IBM i modernization, PHP, Python, Node.js, and modern RPG" /></a>

Creators of [CommunityPlus+ PHP for IBM i](https://www.seidengroup.com/communityplus-php-for-ibm-i/) featuring ZF1-Future

# ZF1 is Now Version 1.21!
### Over 200 updates and bug fixes since 1.12!
The ZF1 community has been hard at work updating Zend Framework with all of the latest features of PHP 8 and 8.1.

# Documentation
New ZF1-Future Manual: [ZF1-Future Docs](https://zf1future.com/manual)

### Original Docs
The original docs can be found here: https://framework.zend.com/manual/1.12/en/manual.html

### Installation

Installable through git clone or through  
`composer require shardj/zf1-future` https://packagist.org/packages/shardj/zf1-future  

# System Requirements
ZF1 Future runs on any version of PHP between 7.1 and 8.1! (see composer.json)

# License
The files in this archive are released under the Zend Framework license. You can find a copy of this license in [LICENSE.txt](LICENSE.txt).

# Related Projects

*  [ZF1 Extras Future](https://github.com/Shardj/zf1-extras-future)
* [ZF1s](https://github.com/zf1s) - Another community supported continuation of ZF1, with a focus on splitting the frameworks original components into individual packages

# Known issues and solutions

* ``Bootstrap error: Unable to resolve plugin "useragent"; no corresponding plugin with that name``  
   See comments in: https://github.com/Shardj/zf1-future/issues/92
