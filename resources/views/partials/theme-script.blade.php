<script>
(function() {
    function getStoredTheme() {
        try {
            return localStorage.getItem('emodul-theme') || 'system';
        } catch (e) {
            return 'system';
        }
    }

    function applyTheme(theme) {
        var isDark = false;
        if (theme === 'dark') {
            isDark = true;
        } else if (theme === 'light') {
            isDark = false;
        } else {
            isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        var root = document.documentElement;
        if (isDark) {
            root.classList.add('dark');
            root.classList.remove('light');
            root.style.colorScheme = 'dark';
        } else {
            root.classList.remove('dark');
            root.classList.add('light');
            root.style.colorScheme = 'light';
        }

        var metaTheme = document.querySelector('meta[name="theme-color"]');
        if (metaTheme) {
            metaTheme.setAttribute('content', isDark ? '#020617' : '#f8fafc');
        }
    }

    // Terapkan segera untuk mencegah kilatan tema (anti-FOUC)
    var currentTheme = getStoredTheme();
    applyTheme(currentTheme);

    // Pasang helper pada window untuk sinkronisasi komponen tema
    window.__emodulTheme = {
        get: getStoredTheme,
        set: function(theme) {
            try {
                localStorage.setItem('emodul-theme', theme);
            } catch (e) {}

            var root = document.documentElement;
            root.classList.add('theme-transition');
            applyTheme(theme);
            window.dispatchEvent(new CustomEvent('emodul-theme-change', { detail: { theme: theme } }));
            setTimeout(function() {
                root.classList.remove('theme-transition');
            }, 250);
        },
        apply: applyTheme
    };

    // Pantau perubahan prefers-color-scheme dari sistem
    if (window.matchMedia) {
        var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        var handleMediaChange = function() {
            if (getStoredTheme() === 'system') {
                applyTheme('system');
                window.dispatchEvent(new CustomEvent('emodul-theme-change', { detail: { theme: 'system' } }));
            }
        };
        if (mediaQuery.addEventListener) {
            mediaQuery.addEventListener('change', handleMediaChange);
        } else if (mediaQuery.addListener) {
            mediaQuery.addListener(handleMediaChange);
        }
    }
})();
</script>
