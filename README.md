# GPT Admin Platform

این پروژه یک سکوی مدیریت چندسازمانی بر بستر لاراول است که شامل ورود از طریق OAuth2، پنل مدیریت مجزا، فرم‌ساز پویا و سازنده گزارش متصل به API‌های مختلف می‌شود.

## امکانات کلیدی

- **ورود از طریق OAuth2** با استفاده از Socialite و صدور توکن‌های API توسط Laravel Passport.
- **پنل مدیریت چندسازمانی** برای ساخت و مدیریت پنل‌های مشتری و تخصیص کاربران با نقش‌های اختصاصی.
- **فرم‌ساز پویا** با ذخیره‌سازی ساختار فرم به صورت JSON و اتصال به منابع داده خارجی.
- **سازنده گزارش** با تعریف Query های JSON و اجرای آن‌ها روی منابع داده HTTP یا داخلی.

## راه‌اندازی

1. پیش‌نیازها: PHP 8.2، Composer، MySQL/PostgreSQL، Redis (اختیاری برای صف)، Node.js برای دارایی‌های فرانت در صورت نیاز.
2. وابستگی‌ها را نصب کنید:

   ```bash
   composer install
   npm install && npm run build # در صورت استفاده از Vite
   ```

3. فایل env را آماده کنید:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. اطلاعات اتصال دیتابیس، تنظیمات OAuth و مقادیر Passport را در `.env` وارد کنید (برای Google/GitHub/Azure می‌توانید از متغیرهای اختصاصی یا مقادیر عمومی `OAUTH_*` استفاده کنید)، سپس مهاجرت‌ها را اجرا کنید:

   ```bash
   php artisan migrate --seed
   php artisan passport:install
   ```

5. برای اجرای محلی:

   ```bash
   php artisan serve
   ```

   یا از Sail / Docker-compose دلخواه خود بهره بگیرید.

## ساختار ماژول‌ها

- `app/Http/Controllers/Auth/OAuthController`: مدیریت جریان OAuth2.
- `app/Http/Controllers/Admin/*`: کنترلرهای پنل مدیریت برای پنل‌ها، فرم‌ها، گزارش‌ها و منابع داده.
- `app/Models`: مدل‌های اصلی شامل Panel، FormDefinition، ReportDefinition و DataSource.
- `app/Services/Reports/ReportRunner`: موتور اجرای گزارش با پشتیبانی از اتصال HTTP و داخلی.
- `config/panel.php`: تنظیمات فرم‌ساز و گزارش‌ساز.
- `database/migrations`: ساختار دیتابیس.

## نکات توسعه

- برای اضافه کردن درایور جدید گزارش، کلاس `ReportRunner` را گسترش دهید.
- سیاست‌های دسترسی سفارشی را از طریق Spatie Permission تعریف کنید.
- برای ایجاد رابط کاربری پیشرفته‌تر می‌توانید Blade Component یا Vue/React اضافه کنید.

## مجوز

صرفاً جهت استفاده در پروژهٔ سفارشی.
