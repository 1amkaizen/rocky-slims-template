const temp = `
    <div class="flex flex-wrap">
        <div class="w-full my-2">
            <span>{{ $store.state.biblioMark +' '+ numLabel }}</span>
        </div>
        <div class="w-full">
            <button class="bg-green-600 hover:bg-green-500 rounded-md py-2 px-3 text-white">{{ btnReserveLabel }}</button>
            <button v-on:click="clearBasket" class="bg-yellow-600 hover:bg-yellow-500 rounded-md py-2 px-3 text-white">{{ btnReserveClear }}</button>
            <button v-on:click="removeItemSelected" class="bg-red-600 hover:bg-red-500 py-2 px-3 rounded-md text-white">{{ btnReserveRemove }}</button>
        </div>
        <div class="w-full mt-3">
            <table v-if="lists.length" class="w-full table table-striped table-hover" border="1" style="border-collapse: collapse">
                <thead>
                    <tr class="dataListHeader text-white">
                        <th class="p-3" style="width: 5%">Remove</th>
                        <th class="p-3 w-5/6">Title</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="list in lists" class="cursor-pointer">
                        <td class="p-3">
                            <input type="checkbox" ref="basket" class="basketItem mx-auto block" :value="list.ID"/>
                        </td>
                        <td class="p-3">
                            {{ list.Title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else class="w-full bg-gray-200 p-3 text-center">
                <b>No Data</b>
            </div>
        </div>
    </div>
`

export default {
    props: {
        btnReserveLabel: {
            type: String,
            default: 'Reserve'
        },
        btnReserveClear: {
            type: String,
            default: 'Clear Basket'
        },
        btnReserveRemove: {
            type: String,
            default: 'Remove selected'
        },
        numLabel: String
    },
    name: 'Basketlist',
    template: temp,
    data() {
        return {
            lists: []
        }
    },
    methods: {
        async getBasket()
        {
            await fetch('index.php?p=api/opac/memberarea/getbasket')
                    .then(response => response.json())
                    .then(result => {
                        if (result.length > 0)
                        {
                            this.lists = result
                        }
                    })
        },
        async clearBasket()
        {
            let formData = new FormData();
            formData.append('clear_biblio', 1)

            await fetch('index.php?p=member', {
                method: 'POST',
                body: formData
            })
            .then(response => {

                if (response.status === 200)
                {
                    this.lists = []
                    this.$store.commit('clearMark')
                    this.toastr('Berhasil menghapus daftar keranjang', 'Info', 'info')
                }
            })
        },
        async removeItemSelected()
        {
            let formData = new FormData()

            this.$refs.basket.forEach(item => {
                if (item.checked)
                {
                    formData.append('basket[]', item.value)
                }
            });

            await fetch('index.php?p=member', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.status === 200)
                {
                    this.toastr('Berhasil menghapus daftar keranjang', 'Info', 'info', 'top')
                }
            })
        }
    },
    mounted()
    {
        this.getBasket()
    }
}