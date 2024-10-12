<div class="mt-5">
    <div class="card">
        <div x-data="tagsCloud" class="card-body">
            <div x-show="tags.length > 0">
                <div class="fs-5">Облако тегов</div>
                <div class="mb-2">
                    <template x-for="tag in tags">
                        <span role="button" class="badge rounded-pill text-bg-primary m-1 p-2"
                            @click="selectTag(tag.name)">
                            <span x-text="tag.name"></span>
                        </span>
                    </template>
                </div>
            </div>
            <div class="mt-2" x-show="selectedTags.length > 0">
                <div class="fs-5">Выбранные теги
                    <i role="button" class="close white-text fas fa-times" @click="removeAllTags"></i>
                </div>
                <template x-for="tag in selectedTags">
                    <span class="badge rounded-pill text-bg-primary me-1 p-2" @click="removeTag(tag)">
                        <span x-text="tag"></span>
                        <i role="button" class="close white-text fas fa-times"></i>
                    </span>
                </template>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tagsCloud', () => ({
                selectedTags: [],
                tags: @json($tagsCloud),
                init() {
                    const params = new URLSearchParams(window.location.search);
                    const tags = params.getAll('tags[]');
                    this.selectedTags = tags;
                },
                selectTag(tag) {
                    this.selectedTags.push(tag);
                    var url = new URL(window.location);
                    url.searchParams.append('tags[]', tag);
                    location.href = url.toString();
                },
                removeTag(tag) {
                    this.selectedTags = this.selectedTags.filter(t => t !== tag);

                    var url = new URL(window.location);

                    url.searchParams.delete('tags[]', tag);

                    location.href = url.toString();
                },
                removeAllTags() {
                    this.selectedTags = [];

                    var url = new URL(window.location);
                    url.searchParams.delete('tags[]');
                    location.href = url.toString();
                }
            }))
        })
    </script>
</div>
