const temp = `
    <div class="flex items-center flex-shrink-0 text-white ml-10">
        <div :class="'search-box rounded-full ' + searchBoxBg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-3 -mt-1 inline-block" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <input type="text" v-on:focus="advanceSearchActive" v-on:blur="advanceSearchDisActive" name="keywords" class="ml-1 inline-block bg-transparent w-11/12" placeholder="search"/>
        </div>
    </div>
`

export default {
    name: 'Searchbox',
    template: temp,
    data() {
        return {
            searchBoxBg: 'bg-gray-700'
        }
    },
    methods: {
        advanceSearchActive()
        {
            this.searchBoxBg = 'bg-gray-500' 
            this.doc.querySelector('.shadow-search').classList.remove('hidden')
        },
        advanceSearchDisActive()
        {
            this.searchBoxBg = 'bg-gray-700' 
            this.doc.querySelector('.shadow-search').classList.add('hidden')
        }
    }
}