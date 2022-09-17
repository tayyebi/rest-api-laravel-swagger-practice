# Add universe
sudo add-apt-repository universe

# Make a temporary folder
mkdir tmp

# Navigate into new workspace
cd tmp

# A hint
echo 'its better to run "apt clean" to clear following cached directories'
echo $(apt clean --dry-run)

# Get a list of deb packages to install
apt-get install -y php7.4-cli php7.4-xml php7.4-curl php7.4-mysql --print-uris | grep ^\' | cut -d\' -f2 > dependencies.txt

# Download packages
wget -i dependencies.txt

# Install packages
dpkg -i *.deb

# Remove temp
cd ..
rm -rf tmp