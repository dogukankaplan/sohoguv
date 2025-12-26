# Deployment Guide - SOHO Güvenlik Sistemleri

## Option 1: Build Locally & Upload (Recommended for Production)

### Step 1: Build locally

```bash
npm run build
```

### Step 2: Upload these files to your VPS

Upload the entire `public/build/` directory to your VPS:

```
Local: C:\Users\HUAWEI\Documents\GitHub\sohoguv\public\build\
VPS:   /var/www/sohoguv/sohoguv/public/build/
```

You can use:

-   **FTP/SFTP** (FileZilla, WinSCP)
-   **Git** (commit and pull on VPS)
-   **rsync** or **scp**

---

## Option 2: Build on VPS (Recommended for Development)

### SSH into your VPS and run:

```bash
cd /var/www/sohoguv/sohoguv

# Install Node.js if not installed
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install dependencies
npm install

# Build CSS
npm run build

# Set permissions
sudo chown -R www-data:www-data public/build
sudo chmod -R 755 public/build
```

---

## Option 3: Use Git (Best Practice)

### On your local machine:

```bash
git add .
git commit -m "New professional design implementation"
git push origin main
```

### On your VPS:

```bash
cd /var/www/sohoguv/sohoguv
git pull origin main
npm install
npm run build
sudo chown -R www-data:www-data public/build
sudo chmod -R 755 public/build
```

---

## Verify Installation

After deployment, check if files exist:

```bash
ls -la /var/www/sohoguv/sohoguv/public/build/
```

You should see:

-   `manifest.json`
-   `assets/` directory with CSS files

---

## Troubleshooting

### If CSS still doesn't load:

1. **Clear Laravel cache:**

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

2. **Check file permissions:**

```bash
sudo chown -R www-data:www-data /var/www/sohoguv/sohoguv/public
sudo chmod -R 755 /var/www/sohoguv/sohoguv/public
```

3. **Check .env file:**
   Make sure `APP_ENV=production` in your `.env` file on VPS

4. **Restart web server:**

```bash
sudo systemctl restart nginx
# or
sudo systemctl restart apache2
```

---

## Quick Deploy Script

Create this file on your VPS: `/var/www/sohoguv/deploy.sh`

```bash
#!/bin/bash
cd /var/www/sohoguv/sohoguv
git pull origin main
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan config:clear
php artisan cache:clear
php artisan view:clear
sudo chown -R www-data:www-data .
sudo chmod -R 755 storage bootstrap/cache public/build
echo "✅ Deployment complete!"
```

Make it executable:

```bash
chmod +x /var/www/sohoguv/deploy.sh
```

Run it:

```bash
./deploy.sh
```
