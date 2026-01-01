/**
 * Modern Sidebar Expand/Collapse Functionality
 */

(function() {
    'use strict';

    const SIDEBAR_STORAGE_KEY = 'sidebarCollapsed';
    
    // Initialize sidebar state
    function initSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle-bottom');
        
        if (!sidebar) {
            return;
        }

        // Check localStorage for saved state
        const isCollapsed = localStorage.getItem(SIDEBAR_STORAGE_KEY) === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        }

        // Restore body class state
        if (isCollapsed) {
            document.body.classList.add('sidebar-toggled');
        }

        // Toggle functionality
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                sidebar.classList.toggle('collapsed');
                
                // Also toggle body class for sb-admin-2 compatibility
                document.body.classList.toggle('sidebar-toggled');
                
                // Save state to localStorage
                const collapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem(SIDEBAR_STORAGE_KEY, collapsed.toString());
                
                // Dispatch custom event for other scripts
                window.dispatchEvent(new CustomEvent('sidebarToggle', {
                    detail: { collapsed: collapsed }
                }));
                
                // Update tooltips after toggle
                setTimeout(() => {
                    updateTooltips(sidebar);
                }, 300);
            });
        }

        // Add tooltip data attributes for collapsed state
        if (sidebar.classList.contains('collapsed')) {
            updateTooltips(sidebar);
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                document.body.classList.remove('sidebar-toggled');
            }
        });
        
        // Update tooltips on initial load
        updateTooltips(sidebar);
    }

    // Update tooltip attributes for navigation items
    function updateTooltips(sidebar) {
        const navItems = sidebar.querySelectorAll('.nav-item');
        navItems.forEach(function(navItem) {
            const navLink = navItem.querySelector('.nav-link span');
            if (navLink && navLink.textContent.trim()) {
                navItem.setAttribute('data-tooltip', navLink.textContent.trim());
            }
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebar);
    } else {
        initSidebar();
    }

    // Handle content wrapper margin
    function adjustContentWrapper() {
        const sidebar = document.querySelector('.sidebar');
        const contentWrapper = document.querySelector('#content-wrapper');
        
        if (sidebar && contentWrapper) {
            const isCollapsed = sidebar.classList.contains('collapsed');
            // Content wrapper margin is handled by CSS, but we can add classes if needed
            if (isCollapsed) {
                contentWrapper.classList.add('sidebar-collapsed');
            } else {
                contentWrapper.classList.remove('sidebar-collapsed');
            }
        }
    }

    // Listen for sidebar toggle events
    window.addEventListener('sidebarToggle', adjustContentWrapper);
    
    // Initial adjustment
    setTimeout(adjustContentWrapper, 100);
})();

