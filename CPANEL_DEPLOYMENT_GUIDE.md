# cPanel'e Deployment Rehberi - SohoGüv Projesi

Bu rehber, React (Frontend) + Laravel (Backend) projenizi cPanel'e yüklemeniz için adım adım talimatlar içerir.

## 📁 Dosya Yapısı (cPanel'de)

```
/home/kullaniciadi/
├── public_html/                    # Frontend (React Build) buraya
│   ├── assets/
│   ├── index.html
│   ├── logo.png
│   ├── robots.txt
│   └── .htaccess                   # Frontend için
│
├── laravel/                        # Backend (Laravel) buraya (public_html DIŞINDA!)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── routes/
│   ├── storage/                    # Yazma izni gerekli!
│   ├── vendor/
│   ├── .env                        # ÖNEMLİ: Production ayarları
│   ├── artisan
│   └── composer.json
│
└── laravel/public/                 # Laravel public klasörü
    └── .htaccess                   # Backend API için
```

## 🚀 Adım Adım Yükleme

### 1️⃣ Veritabanı Oluşturma (cPanel'de)

1. cPanel'e giriş yapın
2. **MySQL® Databases** bölümüne gidin
3. Yeni veritabanı oluşturun:
   - Veritabanı adı: `kullaniciadi_sohoguv`
4. Yeni kullanıcı oluşturun:
   - Kullanıcı adı: `kullaniciadi_sohoguv`
   - Güçlü bir şifre belirleyin
5. Kullanıcıyı veritabanına ekleyin ve **TÜM YETKİLERİ** verin

### 2️⃣ Backend (Laravel) Yükleme

#### A. Dosyaları Yükleyin

1. **File Manager** veya **FTP** ile:
   - `backend` klasörünün **tüm içeriğini** `/home/kullaniciadi/laravel/` klasörüne yükleyin
   - **DİKKAT:** `public_html` içine YÜKLEMEYIN!

#### B. .env Dosyasını Düzenleyin

`/home/kullaniciadi/laravel/.env` dosyasını düzenleyin:

```env
APP_NAME="Soho Güvenlik Sistemleri"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=kullaniciadi_sohoguv
DB_USERNAME=kullaniciadi_sohoguv
DB_PASSWORD=your_database_password_here

# Frontend URL (React build)
FRONTEND_URL=https://yourdomain.com

# CORS Settings
SANCTUM_STATEFUL_DOMAINS=yourdomain.com,www.yourdomain.com

# Session Settings
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=yourdomain.com
```

#### C. composer install ve migrate

cPanel **Terminal** üzerinden:

```bash
cd /home/kullaniciadi/laravel
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### D. İzinleri Ayarlayın

```bash
chmod -R 755 /home/kullaniciadi/laravel/storage
chmod -R 755 /home/kullaniciadi/laravel/bootstrap/cache
```

### 3️⃣ Frontend (React Build) Yükleme

1. **File Manager** veya **FTP** ile:
   - `frontend/dist` klasörünün **tüm içeriğini** `/home/kullaniciadi/public_html/` klasörüne yükleyin
2. Dosya yapısı şöyle olmalı:
   ```
   public_html/
   ├── assets/
   ├── index.html
   ├── logo.png
   ├── robots.txt
   └── .htaccess
   ```

### 4️⃣ .htaccess Dosyalarını Yapılandırma

#### A. Frontend .htaccess (public_html/.htaccess)

Aşağıdaki içeriği kullanın (bu dosya otomatik oluşturulacak).

#### B. API .htaccess için Subdomain veya Klasör

**SEÇENEK 1: Subdomain (ÖNERİLEN)**

1. cPanel'de **Subdomains** bölümüne gidin
2. Subdomain oluşturun: `api.yourdomain.com`
3. Document Root: `/home/kullaniciadi/laravel/public`
4. Laravel'in `public/.htaccess` dosyası zaten mevcut

**SEÇENEK 2: /api Klasörü**

1. `public_html/api` klasörü oluşturun
2. `/home/kullaniciadi/laravel/public` içindeki dosyaları oraya kopyalayın
3. Ancak bu durumda Laravel'in root'unu değiştirmeniz gerekir (karmaşık)

### 5️⃣ API URL'ini Güncelleme

Frontend build dosyalarında API URL değiştirilmesi gerekebilir. Eğer kodunuzda environment variable kullandıysanız:

**public_html/.htaccess** dosyasına ekleyin:

```apache
SetEnv VITE_API_URL https://api.yourdomain.com/api
```

### 6️⃣ Test Etme

1. **Frontend**: `https://yourdomain.com` adresini ziyaret edin
2. **Backend API**: `https://api.yourdomain.com/api/menu` test edin
3. **Health Check**: `https://api.yourdomain.com/api/health` kontrol edin

## ⚠️ Önemli Notlar

### SSL Sertifikası

- cPanel'de **SSL/TLS Status** bölümünden ücretsiz Let's Encrypt SSL aktifleştirin
- Hem ana domain hem de api subdomain için SSL gereklidir

### Güvenlik

- `.env` dosyasının web'den erişilebilir olmamasına dikkat edin
- `APP_DEBUG=false` olmalı (production'da)
- Güçlü şifreler kullanın

### Storage Klasörü

- Laravel'de `storage/app/public` klasörü için symlink gereklidir:
  ```bash
  php artisan storage:link
  ```

### Cronjob (Opsiyonel)

Eğer Laravel Scheduler kullanıyorsanız, cPanel **Cron Jobs** bölümünde:

```
* * * * * cd /home/kullaniciadi/laravel && php artisan schedule:run >> /dev/null 2>&1
```

## 🔧 Sorun Giderme

### 500 Internal Server Error

- `storage` ve `bootstrap/cache` klasör izinlerini kontrol edin (755)
- `.env` dosyasının doğru yapılandırıldığından emin olun
- Laravel log: `/home/kullaniciadi/laravel/storage/logs/laravel.log`

### CORS Hataları

- `.env` dosyasında `SANCTUM_STATEFUL_DOMAINS` doğru ayarlanmış mı?
- Backend'de CORS middleware kontrolü yapın

### Routing Sorunları (React)

- Frontend `.htaccess` dosyasının doğru yapılandırıldığından emin olun
- Tüm route'lar `index.html`'e yönlendiriliyor olmalı

### Database Connection Error

- Veritabanı bilgileri doğru mu?
- Kullanıcı yetkisi var mı?
- `DB_HOST` genelde `localhost` olmalı

## 📞 Destek

Sorun yaşarsanız:

1. Laravel log dosyasını kontrol edin
2. cPanel error log'larına bakın
3. Browser console'da hata var mı kontrol edin

---

**Deploy Öncesi Son Kontrol Listesi:**

- [ ] Veritabanı oluşturuldu
- [ ] Laravel dosyaları `public_html` DIŞINDA yüklendi
- [ ] `.env` dosyası production ayarlarıyla düzenlendi
- [ ] `composer install` çalıştırıldı
- [ ] `php artisan migrate` çalıştırıldı
- [ ] `storage` klasör izinleri ayarlandı
- [ ] Frontend build dosyaları `public_html`'e yüklendi
- [ ] .htaccess dosyaları yerinde
- [ ] SSL sertifikası aktif
- [ ] API test edildi
- [ ] Frontend test edildi
