<div x-data="useCookie">
    <div x-show.important="useCookieShow"
        class="position-fixed bottom-0 end-0 p-3 w-100 bg-primary fs-5 text-white d-flex justify-content-center"
        style="z-index: 5;">

        <div class="d-flex align-items-center">
            Мы используем файлы cookie
            <div role="button" @click="setUseCookieShow(false)">
                <i class="fas fa-close ms-2"></i>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', function() {
                Alpine.data('useCookie', () => ({
                    useCookieShow: Cookies.get('useCookieShow') === 'false' ? false : true,
                    setUseCookieShow(show) {
                        Cookies.set('useCookieShow', show);
                        this.useCookieShow = show;
                    },
                }));
            })
        </script>
    </div>
</div>
