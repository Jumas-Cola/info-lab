<div x-data="themeSwitch">
    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
        <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center text-white"
                id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static"
                aria-label="Toggle theme (dark)">
                <i x-show="theme === 'light'" class="bi bi-brightness-high-fill"></i>
                <i x-show="theme === 'dark'" class="bi bi-moon-stars"></i>

                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center"
                        :class="theme === 'light' ? 'active' : ''" @click="setTheme('light')">
                        <i class="bi bi-brightness-high-fill"></i>
                        Light
                        <svg class="bi ms-auto d-none">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center"
                        :class="theme === 'dark' ? 'active' : ''" @click="setTheme('dark')">
                        <i class="bi bi-moon-stars"></i>
                        Dark
                        <svg class="bi ms-auto d-none">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
            </ul>
        </li>
    </ul>

    <script>
        document.addEventListener('alpine:init', function() {
            Alpine.data('themeSwitch', () => ({
                theme: Cookies.get('theme') ?? 'light',
                init() {
                    document.body.setAttribute('data-bs-theme', this.theme);
                },
                setTheme(theme) {
                    this.theme = theme
                    Cookies.set('theme', theme);
                    document.body.setAttribute('data-bs-theme', this.theme)
                },
            }));
        })
    </script>
</div>
