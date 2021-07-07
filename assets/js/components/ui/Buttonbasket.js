const temp = `
    <div class="grid grid-cols-1 gap-1 grid-cols-1">
        <input v-if="mark" type="hidden" name="biblioMark[]" :value="biblioId"/>
        <a v-if="!mark && isItemAvailable" v-on:click="insertIntoBasket(biblioId, $event)" href="#addToBasket" class="w-12/12 mr-1 btn btn-outline-danger hover:bg-danger-700 text-black font-super-bold text-xs py-2 px-2 m-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-1 bi bi-book" viewBox="0 0 16 16">
                <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
            </svg>
            {{ buttonLabel }}
        </a>
        <a v-if="mark && isItemAvailable" v-on:click="removeFromBasket(biblioId, $event)" title="Klik untuk menghapus dari keranjang" href="#removeFromBasket" class="w-12/12 mr-1 btn btn-secondary text-white font-super-bold text-xs py-2 px-2 m-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-1 bi bi-book" viewBox="0 0 16 16">
                <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            {{ btnLabelBasketSaved }}
        </a>
        <a v-if="!isItemAvailable" v-on:click="$event.preventDefault()" href="#notAvaliable" class="w-12/12 mr-1 btn btn-warning text-black font-super-bold text-xs py-2 px-2 m-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-1 bi bi-book" viewBox="0 0 16 16">
                <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
            </svg>
            Item tidak tersedia
        </a>
    </div>
`;

export default {
    props: {
        buttonLabel: {
            type: String,
            default: 'Basket'
        },
        biblioId: {
            type: String,
            default: "0"
        },
        availibilityItem: String
    },
    name: 'Buttonbasket',
    data() {
        return {
            mark: false,
            btnLabelBasketSaved: 'Tersimpan di keranjang',
            btnLabelOnMouseOver: ''
        }
    },
    template: temp,
    computed: {
        isItemAvailable()
        {
            if (parseInt(this.availibilityItem) > 0)
            {
                return true
            }

            return false
        }
    },
    methods: {
        isMarkBasket(id)
        {
            let mark = JSON.parse(localStorage.getItem('biblioMark'))

            if (typeof mark[`mark${id}`] !== 'undefined')
            {
                this.mark = true
            }
        },
        async insertIntoBasket(id, event)
        {
            event.preventDefault()

            let mark = JSON.parse(localStorage.getItem('biblioMark'))

            if (typeof mark[`mark${id}`] === 'undefined')
            {
                let formData = new FormData()
                formData.append('biblio', id)
                formData.append('callback', 'json')

                await fetch('index.php?p=member', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status)
                    {
                        this.$store.commit('increment')
                        mark[`mark${id}`] = id
                        this.mark = true
                        localStorage.setItem('biblioMark', JSON.stringify(mark))
                        this.toastr('Tersimpan di keranjang', 'Sukses', 'success')
                    }
                    else
                    {
                        alert(result.message)
                    }
                })
            }
        },
        async removeFromBasket(id, event)
        {
            event.preventDefault()

            let mark = JSON.parse(localStorage.getItem('biblioMark'))

            if (typeof mark[`mark${id}`] !== 'undefined')
            {
                fetch(`index.php?p=member&rm_biblio=${id}`)
                .then(response => {
                    delete mark[`mark${id}`]
                    this.mark = false
                    localStorage.setItem('biblioMark', JSON.stringify(mark))
                    this.$store.commit('decrement')
                    return
                })
            }
        }
    },
    mounted()
    {
        if (localStorage.getItem('biblioMark') === null)
        {
            // set up
            localStorage.setItem('biblioMark', JSON.stringify({}))
        }

        this.isMarkBasket(this.biblioId)
    }
}