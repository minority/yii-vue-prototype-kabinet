# Please see the online documentation at
# https://docs.vagrantup.com.

# OPTIONS
require 'yaml'
options = YAML.load_file File.join(File.dirname(__FILE__), '/vagrant/vagrant.yaml')
domains = [
    "seostat.local",
    "backend.seostat.local",
    "storage.seostat.local",
    "kabinet.seostat.local",
    "api.seostat.local",
]
packages = [
    "libxslt1.1",
    "libperl5.18",
    "libluajit-5.1-2",
    "nginx",
    "php7.1",
    "php7.1-zip",
    "php7.1-cli",
    "php7.1-common",
    "php7.1-curl",
    "php7.1-fpm",
    "php7.1-gd",
    "php7.1-intl",
    "php7.1-json",
    "php7.1-mcrypt",
    "php7.1-mysql",
    "php7.1-opcache",
    "php7.1-readline",
    "php7.1-mbstring",
    "php7.1-dom",
    "php7.1-ldap",
    "php-xdebug",
    "mysql-server-5.6",
    "hhvm",
    "git",
    "zip",
    "htop",
    "mc"
]

Vagrant.configure(2) do |config|
  config.vm.post_up_message = "Done! Now you can access site at http://seostat.local"
  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = options['vm']['memory']
    vb.cpus = options['vm']['cpus']
    vb.name = options['vm']['name']
  end

  config.vm.define options['vm']['name'] {}

  config.vm.box = "ubuntu/trusty64"
  config.vm.hostname = domains[0]
  config.vm.network options['network']['type'], ip: options['network']['ip']
  config.vm.synced_folder "./", "/var/www", id: "vagrant-root", :nfs => false, owner: "www-data", group: "www-data"

  config.vm.provision :hostmanager
  config.hostmanager.enabled            = true
  config.hostmanager.manage_host        = true
  config.hostmanager.ignore_private_ip  = false
  config.hostmanager.include_offline    = true
  config.hostmanager.aliases            = domains

  # fix "stdin: is not a tty"
  config.vm.provision "fix-no-tty", type: "shell" do |s|
    s.privileged = false
    s.inline = "sudo sed -i '/tty/!s/mesg n/tty -s \\&\\& mesg n/' /root/.profile"
  end

  config.vm.provision "shell", path: "./vagrant/vagrant.sh", args: [
    packages.join(" "),
    options['github']['token'],
    options['system']['swapsize'],
    options['system']['timezone']
  ]

  config.vm.provision "shell", inline: "service nginx restart", run: "always"
end
