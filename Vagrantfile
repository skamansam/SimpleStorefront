# -*- mode: ruby -*-
# vi: set ft=ruby :
php_app = "SimpleStorefront"
ip_address= "192.168.33.27"

script = <<SCRIPT
echo "Provisioning virtual machine..."
echo "Updating aptitude"
apt-get update -y

echo "Installing Git"
apt-get install git -y > /dev/null

echo "Installing Apache"
apt-get install apache2 -y > /dev/null

echo "Installing PHP7"
add-apt-repository -y ppa:ondrej/php
apt-get update -y
apt-get install -y php7.1
apt-get install -y php7.1-curl
apt-get install -y php7.1-common
apt-get install -y php7.1-cli
apt-get install -y php7.1-readline
apt-get install -y php7.1-xml
apt-get install -y php7.1-zip
apt-get install -y php7.1-mbstring

echo "Installing php7-mysql"
apt-get install -y php7.1-fpm
apt-get install -y php7.1-mysql
apt-get install -y php7.1-mysqlnd
apt-get install -y php7.1-intl

echo "Installing php7-memcached"
apt-get install -y memcached
apt-get install -y php7.1-memcached

echo "Installing php7-mcrypt"
apt-get install -y mcrypt
apt-get install -y php7.1-mcrypt

apt-get install -y supervisor

echo "Installing node and npm"
echo "Installing from NodeSource https://github.com/nodesource/distributions#debinstall matching EB config version node 6"
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
sudo apt-get install -y nodejs

# Installing via NPM so we don't have to load another debian source
echo "Installing gulp and yarn globally"
npm install -g gulp yarn

echo "Installing Composer"
curl -sS https://getcomposer.org/installer | /usr/bin/php -- --install-dir=/usr/bin --filename=composer

echo "Installing mysql-server"
apt-get install debconf-utils -y > /dev/null
debconf-set-selections <<< "mysql-server mysql-server/root_password password 12345"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password 12345"
apt-get install mysql-server -y > /dev/null

mysql -uroot -p12345 -e "SET PASSWORD = PASSWORD('');"

mysql -uroot -e "CREATE DATABASE SimpleStorefront;"

echo "Enabling mod-rewrite"
a2enmod rewrite

echo "Configuring Apache"
perl -p -i -e 's/www-data/vagrant/ge;' /etc/apache2/envvars

cat <<EOF > /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
  DocumentRoot /home/vagrant/SimpleStorefront/web

  <Directory /home/vagrant/SimpleStorefront/web>
    # enable the .htaccess rewrites
    AllowOverride All
    Require all granted
  </Directory>

  ServerAdmin webmaster@localhost

  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

echo "Setting up supervisor"
mv /etc/supervisor/supervisord.conf /etc/supervisor/supervisord.conf.old
ln -s /home/vagrant/$1/misc/vagrantsupervisor.conf /etc/supervisor/supervisord.conf

echo "Restarting Apache2"
service apache2 restart

echo "Credentials Setup"
chown -R vagrant /home/vagrant/.ssh/id_rsa*
chmod 600 /home/vagrant/.ssh/id_rsa*
cat ~/.aws/credentials | grep 'aws' >> ~/.aws/config

echo "generating keys for JWT"
mkdir -p /home/vagrant/SimpleStorefront/var/jwt
openssl genpkey -algorithm RSA -out /home/vagrant/SimpleStorefront/var/jwt/private_key.pem -pkeyopt rsa_keygen_bits:2048
openssl rsa -pubout -in /home/vagrant/SimpleStorefront/var/jwt/private_key.pem -out /home/vagrant/SimpleStorefront/var/jwt/public_key.pem

SCRIPT

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.box_url = "https://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-amd64-vagrant-disk1.box"

  config.vm.network :private_network, ip: (ip_address)

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "4096"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    vb.customize ["modifyvm", :id, "--cpus", 4]
  end

  config.vm.synced_folder ".", "/home/vagrant/#{php_app}", type: "rsync", rsync__auto: true, rsync__exclude: [
 	".git/",
 	".vagrant/",
 	"var/cache/",
 	"vendor/"
  ]

  #AWS Credentials
  config.vm.provision "file", source: "~/.aws/credentials", destination: "/home/vagrant/.aws/credentials"
  config.vm.provision "file", source: "~/.aws/config", destination: "/home/vagrant/.aws/config"

  #SSH Credentials
  config.vm.provision "file", source: "~/.ssh/id_rsa", destination: "/home/vagrant/.ssh/id_rsa"
  config.vm.provision "file", source: "~/.ssh/id_rsa.pub", destination: "/home/vagrant/.ssh/id_rsa.pub"

  config.vm.provision "shell", inline: script, args: php_app

end
