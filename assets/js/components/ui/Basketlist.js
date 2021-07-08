const temp = `
    <div class="flex flex-wrap">
        <div class="w-full my-2">
            <span>{{ $store.state.biblioMark +' '+ numLabel }}</span>
        </div>
        <div class="w-full">
            <button v-on:click="reserveBook" class="bg-green-600 hover:bg-green-500 rounded-md py-2 px-3 text-white">{{ btnReserveLabel }}</button>
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
        numLabel: String,
        reserveType: String
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
            let cacheId = []

            this.$refs.basket.forEach(item => {
                if (item.checked)
                {
                    cacheId.push(item.value)
                    formData.append('basket[]', item.value)
                }
            });
            formData.append('basketRemove', '1')

            await fetch('index.php?p=member', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.status === 200)
                {
                    let data = JSON.parse(localStorage.getItem('biblioMark'))

                    cacheId.forEach(id => {
                        delete data[`mark${id}`]
                        this.$store.commit('decrement')
                    })

                    localStorage.setItem('biblioMark', JSON.stringify(data))
                    this.toastr('Berhasil menghapus data dari keranjang', 'Info', 'info', 'bottom')

                    setTimeout(() => {
                        location.reload()
                    }, 500);
                }
            })
        },
        async reserveBook()
        {
            let formData = new FormData();
            formData.append('sendReserve', '1')

            await fetch('index.php?p=member', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                
                let error = 0;
                let successReserve = ''
                let errorReserve = ''
            
                if (typeof result[0] === 'undefined')
                {
                    this.toastr(result.message, 'Galat', 'error')
                    return
                }


                result.forEach(reserve => {
                    if (reserve.status === 'SUCCESS')
                    {
                        successReserve += reserve.message + ', '
                    }
                    else
                    {
                        errorReserve += reserve.message
                        error++
                    }
                })
                
                if (error === 0)
                {
                    this.toastr(successReserve, 'Sukses', 'success')
                    setTimeout(() => { location.reload() }, 5000)
                }
                else
                {
                    this.toastr(errorReserve, 'Galat', 'error')
                }
            })
            // .catch((error) => {
            //     this.toastr('Sesi habis, atau ada hal lain. Silahkan login lagi.', 'Galat', 'error')
            //     setTimeout(() => { location.href = '?p=member' }, 5000)
            // })
        },
    },
    mounted()
    {
        this.getBasket()
    }
}