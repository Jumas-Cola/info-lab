<form id="search" x-data="search" action="#">
    <input type="text" placeholder="Поиск" id='searchText' name="searchKeyword" x-model.throttle.500ms="query" />
    <i class="fa fa-search"></i>
    <div class="dropdown">
        <ul id="searchResults" class="dropdown-menu show" x-show="searchResults.length > 0">
            <template x-for="searchResult in searchResults">
                <li :key="searchResult.title">
                    <a class="dropdown-item" :href="searchResult.url" x-text="searchResult.title"></a>
                </li>
            </template>
        </ul>
    </div>
</form>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('search', () => ({
            query: '',
            searchResults: [],
            init() {
                this.$watch('query', value => this.handle(value))
            },
            async handle(query) {
                if (query.length >= 3) {
                    fetch(`/search?query=${query}`)
                        .then(response => response.json())
                        .then(results => {
                            if (results.length > 0) {
                                this.searchResults = results
                            } else {
                                this.searchResults = [{
                                    title: 'Ничего не найдено',
                                    url: '#',
                                }]
                            }
                        });
                } else {
                    this.searchResults = [];
                }
            }
        }))
    })
</script>