# 🚀 cPanel Hızlı Deployment Kontrol Listesi

## ✅ Yükleme Öncesi Kontroller

### 1. Yerel Build Testi

- [ ] `npm run build` başarılı
- [ ] `dist` klasörü oluştu
- [ ] Backend testleri geçiyor
- [ ] `.env.production.example` dosyası hazır

### 2. cPanel Hazırlığı

- [ ] cPanel erişim bilgileri hazır
- [ ] FTP/SFTP bilgileri hazır (File Manager kullanmıyorsanız)
- [ ] Domain adı aktif

---

## 📦 Dosya Yükleme

### Backend Yükleme (Laravel)

**Hedef:** `/home/kullaniciadi/laravel/` (public_html DIŞINDA!)

Yüklenecek dosyalar:

```
✅ app/
✅ bootstrap/
✅ config/
✅ database/
✅ public/
✅ resources/
✅ routes/
✅ storage/
✅ vendor/ (veya sonra composer install)
✅ .env.example → .env olarak yükle ve düzenle
✅ artisan
✅ composer.json
✅ composer.lock
```

**YÜKLEMEYIN:**

```
❌ node_modules/
❌ tests/
❌ .git/
❌ .env (yerel)
❌ README.md
```

### Frontend Yükleme (React Build)

**Hedef:** `/home/kullaniciadi/public_html/`

Yüklenecek dosyalar (`frontend/dist` içinden):

```
✅ assets/ klasörü
✅ index.html
✅ logo.png
✅ robots.txt
✅ vite.svg
✅ .htaccess (frontend-htaccess-for-cpanel.txt'den oluştur)
```

---

## 🗄️ Veritabanı Kurulumu

### cPanel MySQL Databases

1. **Veritabanı Oluştur**

   - İsim: `kullaniciadi_sohoguv`
   - [ ] Oluşturuldu

2. **Kullanıcı Oluştur**

   - İsim: `kullaniciadi_sohoguv`
   - Şifre: `___________________` (kaydet!)
   - [ ] Oluşturuldu

3. **Kullanıcıyı Veritabanına Ekle**
   - Tüm yetkiler ver (ALL PRIVILEGES)
   - [ ] Eklendi

---

## ⚙️ Backend Konfigürasyon

### .env Dosyası Düzenleme

Dosya: `/home/kullaniciadi/laravel/.env`

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://____________.com

DB_DATABASE=kullaniciadi_sohoguv
DB_USERNAME=kullaniciadi_sohoguv
DB_PASSWORD=____________

FRONTEND_URL=https://____________.com
SESSION_DOMAIN=____________.com
SANCTUM_STATEFUL_DOMAINS=____________.com,www.____________.com
```

**Kontroller:**

- [ ] APP_DEBUG=false
- [ ] Veritabanı bilgileri doğru
- [ ] Domain adları doğru
- [ ] Mail ayarları yapıldı (opsiyonel)

### Terminal Komutları

cPanel Terminal'den çalıştır:

```bash
# 1. Laravel klasörüne git
cd ~/laravel

# 2. Composer bağımlılıklarını yükle
composer install --optimize-autoloader --no-dev

# 3. Uygulama anahtarı oluştur
php artisan key:generate

# 4. Veritabanı migration
php artisan migrate --force

# 5. Storage link oluştur
php artisan storage:link

# 6. Cache'leri oluştur
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. İzinleri ayarla
chmod -R 755 ~/laravel/storage
chmod -R 755 ~/laravel/bootstrap/cache
```

**Çalıştırılanlar:**

- [ ] composer install
- [ ] key:generate
- [ ] migrate
- [ ] storage:link
- [ ] cache komutları
- [ ] chmod izinleri

---

## 🌐 Subdomain Kurulumu (API için - ÖNERİLEN)

### cPanel Subdomains

1. **Subdomain Oluştur**

   - Subdomain: `api`
   - Domain: `yourdomain.com`
   - Document Root: `/home/kullaniciadi/laravel/public`
   - [ ] Oluşturuldu

2. **SSL Sertifikası**
   - cPanel → SSL/TLS Status
   - `api.yourdomain.com` için Let's Encrypt aktifleştir
   - [ ] SSL aktif

---

## 🔒 SSL Sertifikası

### cPanel SSL/TLS Status

- [ ] Ana domain SSL aktif: `yourdomain.com`
- [ ] www SSL aktif: `www.yourdomain.com`
- [ ] API subdomain SSL aktif: `api.yourdomain.com`

---

## 🧪 Test & Doğrulama

### Frontend Testleri

- [ ] `https://yourdomain.com` açılıyor
- [ ] Ana sayfa düzgün yükleniyor
- [ ] Navigasyon çalışıyor
- [ ] React Router çalışıyor (sayfa yenileme testi)
- [ ] Logo ve görseller görünüyor

### Backend API Testleri

Test URL'leri (browser veya Postman ile):

1. **Health Check:**

   ```
   GET https://api.yourdomain.com/api/health
   ```

   - [ ] 200 OK yanıtı

2. **Menu Items:**

   ```
   GET https://api.yourdomain.com/api/menu
   ```

   - [ ] JSON response

3. **Services:**

   ```
   GET https://api.yourdomain.com/api/services
   ```

   - [ ] JSON response

4. **Contact Form:**

   ```
   POST https://api.yourdomain.com/api/contact
   Content-Type: application/json

   {
     "name": "Test",
     "email": "test@test.com",
     "subject": "Test",
     "message": "Test message"
   }
   ```

   - [ ] Çalışıyor

### Admin Panel Testi

```
https://yourdomain.com/admin/login
```

- [ ] Login sayfası açılıyor
- [ ] Giriş yapılabiliyor
- [ ] Dashboard yükleniyor

### CORS Testi

Browser Console'da:

```javascript
fetch("https://api.yourdomain.com/api/menu")
  .then((r) => r.json())
  .then((d) => console.log(d));
```

- [ ] CORS hatası yok
- [ ] Data geliyor

---

## ⚡ Performans Optimizasyonları

### Backend

- [ ] Config cache aktif
- [ ] Route cache aktif
- [ ] View cache aktif
- [ ] OPcache aktif (cPanel PHP Options)

### Frontend

- [ ] Gzip compression (.htaccess)
- [ ] Browser caching (.htaccess)
- [ ] Image optimization

---

## 📊 Son Kontroller

### Güvenlik

- [ ] APP_DEBUG=false
- [ ] Güçlü şifreler kullanıldı
- [ ] .env dosyası web'den erişilemiyor
- [ ] Admin şifresi değiştirildi
- [ ] Database kullanıcı yetkileri minimal

### Dosya İzinleri

- [ ] `storage/` → 755
- [ ] `bootstrap/cache/` → 755
- [ ] Diğer dosyalar → 644
- [ ] Klasörler → 755

### SEO

- [ ] robots.txt yerinde
- [ ] Sitemap oluşturuldu (opsiyonel)
- [ ] Meta tags doğru

---

## 🐛 Sorun Giderme

### 500 Internal Server Error

1. `~/laravel/storage/logs/laravel.log` kontrol et
2. cPanel Error Logs kontrol et
3. PHP version kontrolü (8.1+)

### CORS Hatası

1. `.env` → `SANCTUM_STATEFUL_DOMAINS` kontrol et
2. Backend CORS middleware kontrol et
3. SSL her iki tarafta aktif mi?

### Database Connection Error

1. `.env` veritabanı bilgileri doğru mu?
2. Kullanıcı yetkisi var mı?
3. MySQL sunucusu çalışıyor mu?

### React Router 404 Hatası

1. `.htaccess` dosyası `public_html`'de mi?
2. RewriteEngine On mu?
3. RewriteRule doğru mu?

---

## 📝 Notlar

### Önemli Path'ler

```
Laravel Root:     ~/laravel/
Laravel Public:   ~/laravel/public/
Frontend:         ~/public_html/
Logs:            ~/laravel/storage/logs/
```

### FTP Bilgileri

```
Host:     ftp.yourdomain.com
Username: kullaniciadi
Password: ____________
Port:     21 (FTP) veya 22 (SFTP)
```

### Database Bilgileri

```
Host:     localhost
Database: kullaniciadi_sohoguv
Username: kullaniciadi_sohoguv
Password: ____________
```

---

## ✨ Deployment Tamamlandı!

Site şu adreslerde yayında:

- 🌐 Frontend: https://yourdomain.com
- 🔌 API: https://api.yourdomain.com
- 👨‍💼 Admin: https://yourdomain.com/admin

**Sonraki Adımlar:**

1. Gerçek içerik ekleme
2. Google Analytics ekleme (opsiyonel)
3. Monitoring kurulumu (opsiyonel)
4. Regular backup planı
5. SSL yenileme takibi
