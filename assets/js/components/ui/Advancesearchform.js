const temp = `
    <div>
        <form class="animate__animated animate__fadeIn" action="index.php" method="get">
            <span class="text-lg w-full block font-bold">Pencarian Spesifik</span>
            <div class="flex flex-wrap -mx-3 mb-6">
                <input type="hidden" name="search" value="search"/>
                <input type="hidden" name="searchtype" value="advance"/>
                <section class="flex flex-wrap w-full" v-for="formField in chunk(field, 2)">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold my-2" for="grid-first-name">
                            {{ formField[0].label }}
                        </label>
                        <input v-if="!formField[0].hasOwnProperty('options')" :name="formField[0].name" :placeholder="formField[0].label" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Doe">
                        <List v-if="formField[0].hasOwnProperty('options') && (formField[0].options.length > 0)" :name-element="formField[0].name" :options-select="formField[0].options"></List>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold my-2" for="grid-last-name">
                        {{ formField[1].label }}
                        </label>
                        <input v-if="!formField[1].hasOwnProperty('options')" :name="formField[1].name" :placeholder="formField[1].label" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Doe">
                        <List v-if="formField[1].hasOwnProperty('options') && (formField[1].options.length > 0)" :name-element="formField[1].name" :options-select="formField[1].options"></List>
                    </div>
                </section>
                <section class="mt-2 mr-3 w-full">
                    <button class="btn btn-primary float-right">Cari</button>
                    <a href="#" class="btn btn-danger float-right mr-1" v-on:click="closeAdv">Tutup</a>
                </section>
            </div>
        </form>
    </div>
`

export default {
    name: 'Advancesearchform',
    template: temp,
    data() {
        return {
            field: [
                {
                    label: 'Judul',
                    type: 'text',
                    name: 'title'
                },
                {
                    label: 'Penulis',
                    type: 'text',
                    name: 'author'
                },
                {
                    label: 'Subyek',
                    type: 'text',
                    name: 'subject'
                },
                {
                    label: 'ISSN/ISBN',
                    type: 'text',
                    name: 'isbn'
                },
                {
                    label: 'ISSN/ISBN',
                    type: 'text',
                    name: 'isbn'
                },
                {
                    label: 'Tipe Koleksi',
                    type: 'text',
                    name: 'colltype'
                },
                {
                    label: 'Lokasi',
                    type: 'text',
                    name: 'location'
                },
                {
                    label: 'GMD',
                    type: 'text',
                    name: 'gmd'
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
                    resultArray.push(arr.slice(start,size));
                    start = Number(start) + 2;
                    size = Number(size) + 2;
                }
            }
            return resultArray;
        },
        closeAdv()
        {
            this.$emit('closeAdv')
            console.log('hallo')
        }
    }
}