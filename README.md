# ISP SaaS - Internet Service Provider Management System

A comprehensive SaaS solution for Internet Service Providers built with Laravel and AdminLTE. This system supports multiple user roles and provides advanced ISP management features including MikroTik integration, RADIUS server management, billing, and customer management.

## Features

### User Roles
- **Super Admin**: Complete system access, module management, advanced reports
- **ISP Owner**: Domain management, reseller management, MikroTik integration
- **Reseller**: Customer management, commission tracking, sub-reseller management  
- **Sub Reseller**: Limited customer management under reseller
- **Staff**: Basic operational tasks
- **Customer**: React-based customer panel for PPPoE users

### Core Functionality
- **MikroTik Router Management**: Full CRUD operations, connection testing, API integration
- **PPPoE User Management**: Complete user lifecycle management with MikroTik sync
- **Domain Management**: TXT record verification for custom domains
- **Billing System**: Automated billing with multiple payment gateway support
- **RADIUS Server Integration**: Complete network authentication management
- **POP Zone Management**: Geographic network management
- **Module System**: Extensible architecture for adding new features
- **Real-time Monitoring**: Live network status and user activity monitoring

### Payment Gateways
- bKash Integration
- Nagad Integration  
- SSLCommerce Integration
- Modular payment system for easy extension

### Technical Features
- **Modern UI**: AdminLTE 4.x with responsive design
- **API First**: RESTful APIs for all functionality
- **Role-based Access Control**: Comprehensive permission system
- **Multi-tenant**: Support for multiple ISP owners
- **Scalable Architecture**: Designed for growth and expansion

## Installation

### Prerequisites
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Node.js and NPM
- Web server (Apache/Nginx)

### Quick Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/arrahman495/sb1-eej1uymn.git
   cd sb1-eej1uymn
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   - Update `.env` file with your database credentials
   - Create a MySQL database for the application

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## Demo Users

After running the seeders, you can login with these demo accounts:

- **Super Admin**: admin@ispsaas.com / password123
- **ISP Owner**: ispowner@demo.com / password123
- **Reseller**: reseller@demo.com / password123
- **Sub Reseller**: subreseller@demo.com / password123
- **Staff**: staff@demo.com / password123

## API Documentation

The system provides comprehensive REST APIs for all functionality:

- **Authentication**: `/api/v1/customer/login`, `/api/v1/customer/logout`
- **Customer Management**: `/api/v1/customer/profile`, `/api/v1/customer/usage`
- **MikroTik Integration**: `/api/v1/mikrotik/routers`, `/api/v1/mikrotik/pppoe-users`
- **PPPoE Management**: `/api/v1/pppoe/users`, `/api/v1/pppoe/usage`

## Configuration

### MikroTik Setup
Configure your MikroTik routers in the ISP Owner panel:
1. Add router with IP, API port, and credentials
2. Test connection to ensure API access
3. Configure PPPoE profiles for customer packages

### RADIUS Configuration
Set up RADIUS server integration:
1. Configure RADIUS server details
2. Set up shared secrets
3. Configure accounting settings

### Payment Gateway Setup
Configure payment gateways in the module system:
1. Upload payment gateway modules
2. Configure API credentials in module settings
3. Activate desired payment methods

## Development

### Adding Custom Modules
1. Create module ZIP package with proper structure
2. Upload through Super Admin panel
3. Configure module dependencies and settings
4. Activate module system-wide

### API Integration
The system is designed API-first, making it easy to integrate with:
- Mobile applications
- Third-party billing systems
- Network monitoring tools
- Customer portals

## Security

- Role-based access control (RBAC)
- CSRF protection on all forms
- SQL injection prevention
- XSS protection
- Secure password hashing
- API rate limiting
- Session security

## Support

For support and documentation:
- GitHub Issues: [Report bugs and feature requests](https://github.com/arrahman495/sb1-eej1uymn/issues)
- Documentation: Check the `/docs` directory for detailed guides
- Community: Join our community discussions

## License

This project is open-source software licensed under the [MIT license](LICENSE).

## Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

---

**Built with ❤️ for ISP providers worldwide**