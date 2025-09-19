import './bootstrap';

// Global JavaScript functions for ISP SaaS
window.ISPSaaS = {
    // Utility functions
    showLoading: function(element) {
        element.disabled = true;
        element.innerHTML = '<span class="loading"></span> Loading...';
    },
    
    hideLoading: function(element, originalText) {
        element.disabled = false;
        element.innerHTML = originalText;
    },
    
    // Notification system
    notify: function(message, type = 'info') {
        const alertClass = `alert-${type}`;
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        `;
        
        // Add to notification container or create one
        let container = document.getElementById('notification-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'notification-container';
            container.style.position = 'fixed';
            container.style.top = '20px';
            container.style.right = '20px';
            container.style.zIndex = '9999';
            container.style.maxWidth = '400px';
            document.body.appendChild(container);
        }
        
        container.insertAdjacentHTML('beforeend', alertHtml);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            const alert = container.querySelector('.alert:last-child');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    },
    
    // AJAX helpers
    request: function(url, options = {}) {
        const defaultOptions = {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        };
        
        return fetch(url, { ...defaultOptions, ...options })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            });
    },
    
    // MikroTik connection test
    testMikrotikConnection: function(routerId) {
        const button = document.getElementById(`test-connection-${routerId}`);
        const originalText = button.innerHTML;
        
        this.showLoading(button);
        
        this.request(`/isp-owner/mikrotiks/${routerId}/test-connection`, {
            method: 'POST'
        })
        .then(data => {
            this.notify(data.message, data.success ? 'success' : 'danger');
        })
        .catch(error => {
            this.notify('Connection test failed', 'danger');
            console.error('Error:', error);
        })
        .finally(() => {
            this.hideLoading(button, originalText);
        });
    },
    
    // PPPoE user sync
    syncPppoeUser: function(userId) {
        const button = document.getElementById(`sync-user-${userId}`);
        const originalText = button.innerHTML;
        
        this.showLoading(button);
        
        this.request(`/isp-owner/pppoe-users/${userId}/sync-from-mikrotik`, {
            method: 'POST'
        })
        .then(data => {
            this.notify(data.message, data.success ? 'success' : 'warning');
            if (data.success) {
                // Refresh the page or update the UI
                location.reload();
            }
        })
        .catch(error => {
            this.notify('Sync failed', 'danger');
            console.error('Error:', error);
        })
        .finally(() => {
            this.hideLoading(button, originalText);
        });
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    if (typeof $ !== 'undefined' && $.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip();
    }
    
    // Auto-hide alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            if (alert.classList.contains('alert-dismissible')) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, 5000);
    
    // Real-time updates for dashboard (if needed)
    if (window.location.pathname.includes('/dashboard')) {
        // Set up periodic updates for online users, etc.
        // This will be implemented with actual MikroTik integration
    }
});