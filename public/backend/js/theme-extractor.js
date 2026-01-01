/**
 * Logo Color Extractor and Theme Application
 * Extracts dominant colors from logo and applies them to dashboard
 */

class ThemeExtractor {
    constructor() {
        this.colors = {
            primary: '#4e73df',
            secondary: '#7c6d3e',
            accent: '#1cc88a',
            dark: '#1d1701',
            light: '#f8f9fc'
        };
    }

    /**
     * Extract dominant colors from an image using canvas
     */
    async extractColorsFromImage(imageUrl) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            
            img.onload = () => {
                try {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    
                    ctx.drawImage(img, 0, 0);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const pixels = imageData.data;
                    
                    // Extract dominant colors
                    const colorMap = new Map();
                    const sampleStep = 10; // Sample every 10th pixel for performance
                    
                    for (let i = 0; i < pixels.length; i += sampleStep * 4) {
                        const r = pixels[i];
                        const g = pixels[i + 1];
                        const b = pixels[i + 2];
                        const a = pixels[i + 3];
                        
                        // Skip transparent or very light pixels
                        if (a < 128) continue;
                        if (r > 240 && g > 240 && b > 240) continue; // Skip white/very light
                        
                        const color = `rgb(${r},${g},${b})`;
                        colorMap.set(color, (colorMap.get(color) || 0) + 1);
                    }
                    
                    // Get top colors
                    const sortedColors = Array.from(colorMap.entries())
                        .sort((a, b) => b[1] - a[1])
                        .slice(0, 5);
                    
                    // Convert to hex and set theme colors
                    if (sortedColors.length > 0) {
                        this.colors.primary = this.rgbToHex(sortedColors[0][0]);
                        if (sortedColors.length > 1) {
                            this.colors.accent = this.rgbToHex(sortedColors[1][0]);
                        }
                        if (sortedColors.length > 2) {
                            this.colors.secondary = this.rgbToHex(sortedColors[2][0]);
                        }
                    }
                    
                    resolve(this.colors);
                } catch (error) {
                    console.error('Error extracting colors:', error);
                    resolve(this.colors); // Return default colors
                }
            };
            
            img.onerror = () => {
                console.warn('Could not load logo image, using default colors');
                resolve(this.colors); // Return default colors
            };
            
            img.src = imageUrl;
        });
    }

    /**
     * Convert RGB string to hex
     */
    rgbToHex(rgb) {
        const match = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        if (!match) return rgb;
        
        const r = parseInt(match[1]);
        const g = parseInt(match[2]);
        const b = parseInt(match[3]);
        
        return '#' + [r, g, b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
    }

    /**
     * Apply extracted colors to dashboard
     */
    applyTheme(colors) {
        const root = document.documentElement;
        
        // Set CSS custom properties
        root.style.setProperty('--theme-primary', colors.primary);
        root.style.setProperty('--theme-secondary', colors.secondary);
        root.style.setProperty('--theme-accent', colors.accent);
        root.style.setProperty('--theme-dark', colors.dark);
        
        // Calculate lighter/darker variations
        const lightPrimary = this.lightenColor(colors.primary, 20);
        const darkPrimary = this.darkenColor(colors.primary, 15);
        const gradient = `linear-gradient(135deg, ${colors.primary} 0%, ${colors.accent} 100%)`;
        
        root.style.setProperty('--theme-primary-light', lightPrimary);
        root.style.setProperty('--theme-primary-dark', darkPrimary);
        root.style.setProperty('--theme-gradient', gradient);
        
        // Store in localStorage for persistence
        localStorage.setItem('dashboardTheme', JSON.stringify(colors));
    }

    /**
     * Lighten a color
     */
    lightenColor(color, percent) {
        const num = parseInt(color.replace('#', ''), 16);
        const amt = Math.round(2.55 * percent);
        const R = Math.min(255, (num >> 16) + amt);
        const G = Math.min(255, ((num >> 8) & 0x00FF) + amt);
        const B = Math.min(255, (num & 0x0000FF) + amt);
        return '#' + (0x1000000 + R * 0x10000 + G * 0x100 + B).toString(16).slice(1);
    }

    /**
     * Darken a color
     */
    darkenColor(color, percent) {
        const num = parseInt(color.replace('#', ''), 16);
        const amt = Math.round(2.55 * percent);
        const R = Math.max(0, (num >> 16) - amt);
        const G = Math.max(0, ((num >> 8) & 0x00FF) - amt);
        const B = Math.max(0, (num & 0x0000FF) - amt);
        return '#' + (0x1000000 + R * 0x10000 + G * 0x100 + B).toString(16).slice(1);
    }

    /**
     * Initialize theme extraction and application
     */
    async init(logoUrl) {
        // Try to load from localStorage first
        const savedTheme = localStorage.getItem('dashboardTheme');
        if (savedTheme) {
            try {
                const colors = JSON.parse(savedTheme);
                this.applyTheme(colors);
                return colors;
            } catch (e) {
                // Continue to extract if parsing fails
            }
        }
        
        // Extract colors from logo
        const colors = await this.extractColorsFromImage(logoUrl);
        this.applyTheme(colors);
        
        return colors;
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', async () => {
    const extractor = new ThemeExtractor();
    const logoUrl = document.querySelector('.sidebar-brand img')?.src || 
                    document.querySelector('link[rel="icon"]')?.href || 
                    '/app/logo.png';
    
    await extractor.init(logoUrl);
    
    // Add loaded class to body for animations
    document.body.classList.add('theme-loaded');
});

