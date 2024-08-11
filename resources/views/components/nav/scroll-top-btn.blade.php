<button
    x-data="scrollTopBtn"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    @scroll.window="checkScrollPosition"
    type="button"
    class="btn btn-primary rounded-circle btn-lg"
    id="btnScrollToTop">
  <i class="fas fa-arrow-up"></i>
</button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scrollTopBtn', () => ({
            btnScrollToTop: document.getElementById('btnScrollToTop'),
            checkScrollPosition(e) {
              const el = event.target.documentElement;
              if (el.scrollTop >= 992) {
                this.btnScrollToTop.style.display = 'block'
              } else {
                this.btnScrollToTop.style.display = 'none'
              }
            }
        }))
    })
</script>
