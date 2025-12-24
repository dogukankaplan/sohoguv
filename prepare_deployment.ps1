# Deployment Hazirlama
$dist = "frontend\dist"
$pkg = "deployment_package"
$zip = "sohoguv_deploy.zip"

if (Test-Path $pkg) { Remove-Item -Recurse -Force $pkg }
if (Test-Path $zip) { Remove-Item -Force $zip }

New-Item -ItemType Directory -Force -Path "$pkg\public_html" | Out-Null
New-Item -ItemType Directory -Force -Path "$pkg\laravel" | Out-Null

# Frontend Copy
Write-Host "Frontend Kopyalaniyor..."
Copy-Item "$dist\*" "$pkg\public_html" -Recurse
if (Test-Path "frontend-htaccess-for-cpanel.txt") {
    Copy-Item "frontend-htaccess-for-cpanel.txt" "$pkg\public_html\.htaccess"
}

# Backend Copy
Write-Host "Backend Kopyalaniyor..."
$items = @("app", "bootstrap", "config", "database", "public", "resources", "routes", "storage", "artisan", "composer.json", "composer.lock", "vendor")
foreach ($i in $items) {
    Copy-Item "backend\$i" "$pkg\laravel" -Recurse
}

# Env Copy
if (Test-Path "backend\env_production_for_deploy.txt") {
    Copy-Item "backend\env_production_for_deploy.txt" "$pkg\laravel\.env"
}

# Documentation
Copy-Item "CPANEL_DEPLOYMENT_GUIDE.md" $pkg
Copy-Item "DEPLOYMENT_CHECKLIST.md" $pkg

# Zip
Write-Host "Zipleniyor..."
Compress-Archive -Path "$pkg\*" -DestinationPath $zip

Write-Host "Tamamlandi: $zip"
