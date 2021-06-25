const temp = `
    <div>
        <form class="animate__animated animate__fadeIn" action="index.php" method="get">
            <span class="text-lg w-full block font-bold">Advance Search</span>
            <span class="closeAdvs">
                <svg v-on:click="closeAdvs" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="cursor-pointer text-gray-500 hover:text-red-800" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </span>
            <div class="flex flex-wrap -mx-3 mb-6">
                <input type="hidden" name="search" value="search"/>
                <input type="hidden" name="searchtype" value="advance"/>
                <section class="flex flex-wrap w-full" v-for="formField in chunk(field, 2)">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" v-if="checkProp(formField[0], 'label')">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold my-2" for="grid-first-name">
                            {{ formField[0].label }}
                        </label>
                        <input v-if="!formField[0].hasOwnProperty('options')" :name="formField[0].name" :placeholder="formField[0].label" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                        <List v-if="formField[0].hasOwnProperty('options') && (formField[0].options.length > 0)" :name-element="formField[0].name" :options-select="formField[0].options"></List>
                    </div>
                    <div class="w-full md:w-1/2 px-3" v-if="checkProp(formField[1], 'label')">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold my-2" for="grid-last-name">
                        {{ formField[1].label }}
                        </label>
                        <input v-if="!formField[1].hasOwnProperty('options')" :name="formField[1].name" :placeholder="formField[1].label" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                        <List v-if="formField[1].hasOwnProperty('options') && (formField[1].options.length > 0)" :name-element="formField[1].name" :options-select="formField[1].options"></List>
                    </div>
                </section>
                <section class="mt-2 mr-3 w-full">
                    <button class="btn btn-primary float-right">Search</button>
                </section>
            </div>
        </form>
    </div>
`

import List from '../ui/List.js'

export default {
    name: 'Advancesearchform',
    template: temp,
    components: {
        List
    },
    data() {
        return {
            field: [
                {
                    label: 'Title',
                    type: 'text',
                    name: 'title'
                },
                {
                    label: 'Author',
                    type: 'text',
                    name: 'author'
                },
                {
                    label: 'Subject',
                    type: 'text',
                    name: 'subject'
                },
                {
                    label: 'ISSN/ISBN',
                    type: 'text',
                    name: 'isbn'
                },
                {
                    label: 'Collation Type',
                    type: 'text',
                    name: 'colltype',
                    options: []
                },
                {
                    label: 'Location',
                    type: 'text',
                    name: 'location',
                    options: []
                },
                {
                    label: 'GMD',
                    type: 'text',
                    name: 'gmd',
                    options: []
                }
            ]
        }
    },
    methods: {
        chunk(arr, size) {
            let resultArray = [];
            let start = 0;
            for (let idx = 0; idx < arr.length; idx++) {
                if (start < arr.length)
                {
                    resultArray.push(arr.slice(start,size))
                    start = Number(start) + 2
                    size = Number(size) + 2
                }
            }
            return resultArray;
        },
        async getLocation() 
        { 
            await fetch('?p=api/opac/common/location')
                    .then(result => result.json())
                    .then(response => {
                        this.field[5].options = response
                    })  
        },
        async getColltype() 
        {   
            await fetch('?p=api/opac/common/colltype')
                    .then(result => result.json())
                    .then(response => {
                        this.field[4].options = response
                    })  
        },
        async getGMD()
        {
            await fetch('?p=api/opac/common/gmd')
                    .then(result => result.json())
                    .then(response => {
                        this.field[6].options = response
                    })  
        },
        closeAdvs()
        {
            this.$emit('closeadv')
        }
    },
    mounted()
    {
        this.getLocation()
        this.getColltype()
        this.getGMD()
    }
}