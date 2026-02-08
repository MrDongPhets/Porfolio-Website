# MustardDigital CMS

## 🌟 Features

### Public Website
- **Dynamic Hero Section** - Customizable headline, subtitle, CTA, and background image
- **About Section** - Tell your story with rich text and images
- **Services Showcase** - Display your services with icons and descriptions
- **Portfolio Gallery** - Filterable project showcase with categories
- **Client Testimonials** - Star ratings and client feedback carousel
- **Contact Form** - Secure message submission with spam protection
- **Dark/Light Theme** - Persistent theme toggle with localStorage
- **Fully Responsive** - Mobile-first design that works on all devices

### Admin Panel
- **Secure Authentication** - Password-protected admin access with session management
- **Dashboard Analytics** - Real-time statistics and recent activity overview
- **Content Management**:
  - Hero section editor with image upload
  - About section with WYSIWYG content
  - Services CRUD operations
  - Portfolio manager with category filtering
  - Testimonials with star ratings
  - Work process steps customization
- **Message Center** - View and manage contact form submissions
- **Media Library** - Supabase Storage integration for file management
- **Site Settings** - Global configuration (site name, email, social links)
- **Modern UI** - Clean, intuitive interface with sidebar navigation

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+ (Native, no frameworks)
- **Database**: Supabase (PostgreSQL with REST API)
- **Storage**: Supabase Storage (for images and media)
- **Frontend**: HTML5, CSS3, Vanilla JavaScript, jQuery
- **Security**: 
  - Row Level Security (RLS) policies
  - CSRF protection
  - Password hashing (bcrypt)
  - Rate limiting
  - XSS prevention

## 📋 Prerequisites

- PHP 7.4 or higher
- Web server (Apache/Nginx) with PHP support
- Supabase account (free tier works)
- Composer (optional, for dependencies)

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/MrDongPhets/Porfolio-Website.git
cd mustarddigital-cms
```

### 2. Set Up Supabase

1. Create a new project at [supabase.com](https://supabase.com)
2. Run the SQL schema from `dumpsql.txt` in the Supabase SQL Editor
3. Create a storage bucket named `MUSTARD` in Supabase Storage
4. Make the bucket public for serving images

### 3. Configure Environment

Copy `.env.example` to `.env` and fill in your credentials:

```bash
cp .env.example .env
```

Edit `.env`:

```env
# Supabase Configuration
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_KEY=your_anon_key
SUPABASE_SERVICE_KEY=your_service_role_key

# Site Configuration
SITE_URL=http://your-domain.com
ADMIN_EMAIL=admin@yourdomain.com
```

### 4. Create Admin User

Navigate to `/admin/create-user-debug.php` in your browser to create the first admin user:

```
Default credentials:
Email: admin@mustarddigital.com
Password: admin123
```

⚠️ **Important**: Delete `create-user-debug.php` after creating your admin account!

### 5. Configure Web Server

#### Apache (.htaccess)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [L,QSA]
```

#### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

## 📁 Project Structure

```
mustarddigital-cms/
├── admin/                  # Admin panel
│   ├── includes/          # Admin templates
│   ├── hero.php           # Hero section editor
│   ├── about.php          # About section editor
│   ├── portfolio.php      # Portfolio manager
│   ├── testimonials.php   # Testimonials manager
│   ├── messages.php       # Contact messages
│   └── settings.php       # Site settings
├── assets/                # Public assets
│   ├── css/              # Stylesheets
│   └── uploads/          # Local uploads (legacy)
├── config/               # Configuration files
│   ├── config.php        # Main config
│   └── database.php      # Supabase client
├── includes/             # Helper functions
│   └── functions.php     # Utility functions
├── css/                  # Public stylesheets
│   ├── style.css         # Main stylesheet
│   └── admin.css         # Admin panel styles
├── index.php             # Homepage
├── portfolio.php         # Portfolio page
├── contact-handler.php   # Contact form handler
├── .env                  # Environment variables
└── README.md            # This file
```

## 🔒 Security Features

### Row Level Security (RLS)
- Public users can only **read** active content
- Admin operations use service role key to bypass RLS
- Contact form allows public **insert** only

### Authentication
- Secure password hashing with bcrypt
- Session management with httponly cookies
- CSRF token protection
- Rate limiting on login attempts

### Input Validation
- SQL injection prevention via prepared statements
- XSS protection with output escaping
- File upload validation (type, size)
- Email validation

## 📝 Usage

### Admin Panel

1. Navigate to `/admin`
2. Login with your credentials
3. Use the sidebar to manage content:
   - **Dashboard**: Overview and quick actions
   - **Hero Section**: Edit homepage hero
   - **About Section**: Manage about content
   - **Services**: Add/edit services
   - **Portfolio**: Upload project images
   - **Testimonials**: Manage client reviews
   - **Messages**: View contact submissions
   - **Settings**: Configure site-wide options

### Content Management

#### Adding Portfolio Items
1. Go to **Portfolio** in admin
2. Click **Add Portfolio Item**
3. Fill in details (title, category, description)
4. Upload project image (1200x800px recommended)
5. Optionally mark as featured
6. Save

#### Managing Testimonials
1. Go to **Testimonials** in admin
2. Click **Add Testimonial**
3. Enter client name, company, testimonial text
4. Set star rating (1-5)
5. Set display order
6. Save

## 🎨 Customization

### Theme Colors

Edit CSS variables in `css/style.css`:

```css
:root {
  --bg: #ffffff;
  --text: #111827;
  --accent: #184d37;  /* Primary brand color */
  --card: #f7faf6;
}
```

### Admin Panel Styling

Modify `css/admin.css`:

```css
:root {
  --primary: #184d37;
  --sidebar-width: 260px;
}
```

## 🔧 Configuration Options

### File Upload Limits

Edit in `config/config.php`:

```php
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
```

### Session Timeout

Adjust in `.env`:

```env
SESSION_LIFETIME=3600  # 1 hour
```

## 📊 Database Schema

### Key Tables

- **users** - Admin users
- **hero_section** - Homepage hero content
- **about_section** - About page content
- **services** - Services offered
- **portfolio_items** - Project showcase
- **testimonials** - Client reviews
- **work_steps** - Process steps
- **contact_messages** - Contact form submissions
- **site_settings** - Global settings
- **media_library** - Uploaded files metadata

## 🐛 Troubleshooting

### Images Not Loading

1. Check Supabase Storage bucket is public
2. Verify `SUPABASE_URL` in `.env`
3. Check image URLs in database contain full Supabase URLs
4. Run `/admin/debug-hero.php` to test uploads

### Login Issues

1. Verify admin user exists in database
2. Check password hash is correct
3. Ensure `.env` credentials are valid
4. Run `/admin/debug.php` to diagnose
5. Check session configuration in `config/config.php`

### Database Connection Errors

1. Verify Supabase project is active
2. Check API keys in `.env`
3. Ensure RLS policies are applied
4. Test connection with `/admin/check-db.php`

## 🚀 Deployment

### Production Checklist

- [ ] Change default admin credentials
- [ ] Delete debug files (`create-user-debug.php`, `debug.php`, etc.)
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Disable error display: `ini_set('display_errors', 0)`
- [ ] Enable HTTPS
- [ ] Set secure cookie flags
- [ ] Configure proper file permissions (755 for directories, 644 for files)
- [ ] Set up automatic backups
- [ ] Configure SMTP for email notifications (optional)

### Recommended Hosting

- **Shared Hosting**: Any PHP-enabled host (Hostinger, Bluehost, etc.)
- **VPS**: DigitalOcean, Linode, Vultr
- **Managed**: Cloudways, Laravel Forge (with custom deployment)

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**MustardDigital Team**
- Website: [mustarddigitals.com](https://mustarddigitals.com/)
- Email: hello@mustarddigital.com

## 🙏 Acknowledgments

- [Supabase](https://supabase.com) - Backend as a Service
- [Font Awesome](https://fontawesome.com) - Icons
- [Inter Font](https://rsms.me/inter/) - Typography
- [jQuery](https://jquery.com) - JavaScript library

## 📞 Support


For general questions, contact us at support@mustarddigital.com

---

Made with ❤️ by MustardDigital