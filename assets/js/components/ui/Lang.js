const temp = `
    <div class="dropdown inline-block" v-on:click="openDropDown" style="position: absolute !important; right: 5px;">
        <button class="btn btn-sm text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img :src="baseUrl('template/default/assets/flags/4x3/'+defaultFlag+'.svg')" class="inline-block w-5 h-5 mx-1"/>
        </button>
        <div :class="'dropdown-menu ' + dropDownActive" aria-labelledby="dropdownMenuButton" style="right: 5px;top: 50px; padding-right: 25px;">
            <a class="dropdown-item cursor-pointer" v-for="lang in processLang" :href="baseUrl('?select_lang='+lang.code)">
                <img :src="baseUrl('template/default/assets/flags/4x3/'+lang.icon+'.svg')" class="inline-block w-5 h-5 mx-1"/>
                <label class="cursor-pointer">{{ lang.label }}</label>
            </a>
        </div>
    </div>
`

export default {
    props: {
        defaultFlag: {
            type: String,
            default: ''
        },
        listOtherLang: {
            type: String,
            default: ''
        }
    },
    name: 'Lang',
    template: temp,
    data() {
        return {
            dropDownActive: null
        }
    },
    computed: {
        processLang()
        {
            let quotation = this.listOtherLang.replace(/\'/g, '"')
            let removeQuote = quotation.substring(1,(quotation.length - 1))
            return JSON.parse(removeQuote);
        }
    },
    methods: {
        langInHtml(lang)
        {
            return lang.icon +' '+ lang.label
        },
        openDropDown()
        {
            if (this.dropDownActive === null)
            {
                this.dropDownActive = 'd-block'
            }
            else
            {
                this.dropDownActive = null
            }
        }
    }
}