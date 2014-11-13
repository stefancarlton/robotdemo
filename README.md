
Robot Demo
================================
PHP application to demonstrate a solution to the Toy Robot Simulator problem (see docs for requirements).

Requirements
================================

* PHP5.4+
* PHPUnit

Vagrant
================================

A virtual machine is supplied which is preconfigured with the requirements needed to run this test. 
Ansible requires a Unix based host to operate:

* Install vagrant : http://www.vagrantup.com/
* Install virtualbox : https://www.virtualbox.org/
* Install Ansible : http://docs.ansible.com/intro_installation.html
* Open terminal, navigate to folder containing code
* run the following commands 
        
        vagrant up
		
Manually
================================

If you'd prefer not to use the VM, ensure you have PHP, PHPUnit and Curl installed on a *nix system. Open a terminal window, navigate to the extracted code and run the following commands

        cd /path/to/extracted/code
        curl -sS https://getcomposer.org/installer | php
		php composer.phar install

Tests
================================

Tests are completed using PHPUnit. To execute, bring the VM up (see Vagrant) and remain in the folder containing the code. Run the following commands:

        vagrant ssh robotdemo
		cd /var/www/demo/src/robotdemo/Tests
		phpunit --verbose

Data input / output
================================

Data is held in standard text files with one instruction per line. Datafiles live in /src/robotdemo/Data. These squences (excluding the Report command) are also duplicated in Tests/Instructions/MultipleInstructionsTest.
To execute, bring the VM up (see Vagrant) and remain in the folder containing the code. Run the following commands:

		vagrant ssh robotdemo
		cd /var/www/demo/src/robotdemo/
		php run.php RunOne.txt
		
Assumptions
================================

* Vertical moves may be allowed in a 3 dimensional space
* The Arena is square but could be replaced with more complicated shapes
* Combination moves might be used (e.g. the Rook chess piece's - move, move, left|right, move)
* Multiple robots may be placed in the arena (or static objects)