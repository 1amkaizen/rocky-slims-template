const temp = `
    <div class="banner h-64 mt-16 in-zi">
        <h1 class="brand font-bold text-center text-gray-100 mt-20 mb-0 shadow-2xl">OPAC</h1>
        <span v-show="parseInt(this.quotesActive)" class="block text-center text-gray-100">"{{ quote }}"</span>
        <small v-show="parseInt(this.quotesActive)" class="block text-gray-100 text-center">- {{ author }} </small>
    </div>
`

export default {
    props: {
        quotesActive: String
    },
    name: 'Banner',
    template: temp,
    data() {
        return {
            quote: '',
            author: ''
        }
    },
    methods: {
        async getOnlineQuote()
        {
            if (parseInt(this.quotesActive) === 1 && (window.navigator.onLine))
            {
                await fetch('https://api.quotable.io/random?maxLength=100&tags=technology|science|wisdom|education')
                    .then(response => response.json())
                    .then(result => {
                        this.quote = result.content
                        this.author = result.author
                    })
                    .catch(() => {
                        this.setLocalQuote()
                    })
            }
        },
        setLocalQuote()
        {
            this.quote = 'Nothing is pleasanter than exploring a library.'
            this.author = 'Walter Savage Landor'
        }
    },
    mounted()
    {
        this.$nextTick(() => {
            this.getOnlineQuote()
        })
    }
}