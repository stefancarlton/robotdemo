Vagrant.configure("2") do |config|
  config.vm.define :demo do |demo|
    demo.vm.box = "Wheezy64"

    # URL to base box image
    demo.vm.box_url = "https://github.com/jose-lpa/packer-debian_7.6.0/releases/download/1.0/packer_virtualbox-iso_virtualbox.box"

    demo.vm.network :private_network, ip: "192.168.9.18"
    demo.vm.synced_folder ".", "/var/www/demo"

    demo.vm.provider "virtualbox" do |v|
      v.customize ["modifyvm", :id, "--memory", 1584]
    end

    config.vm.provision "ansible" do |ansible|
      ansible.playbook = "ansible/demo.vm.yml"
    end
  end
end
