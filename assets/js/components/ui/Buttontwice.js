const temp = `
    <div class="grid grid-cols-1 gap-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
        <a v-on:click="showDetail($event)" href="#citation" class="w-12/12 mr-1 btn btn-outline-primary hover:bg-blue-700 text-black font-super-bold text-xs py-2 px-2 m-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-1 bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
            </svg>
            Detail
        </a>
        <a v-on:click="showModal($event)" href="#citation" class="w-12/12 ml-1 btn btn-outline-success hover:bg-green-500 text-black font-super-bold text-xs py-2 px-2 m-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-1 bi bi-book" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M7.066 4.76A1.665 1.665 0 0 0 4 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
            </svg>
            Sitasi
        </a>
    </div>
`;

export default {
    props: {
        detailurl: {
            type: String,
            default: ''
        },
        biblioDetail: {
            type: String,
            default: ''
        },
        modalTitle: String,
        modalSrc: String
    },
    name: 'Buttontwice',
    template: temp,
    methods: {
        showDetail(e)
        {
            e.preventDefault()
            window.location= this.detailurl;
        },
        showModal(e)
        {
            e.preventDefault()
            // set overflow hidden
            document.querySelector('body').classList.add('overflow-hidden');
            // set modal
            this.$parent.showModal = true;
            this.$parent.modalAttribute = {
                title: this.modalTitle,
                content: 'Iframe',
                modalWidth: 'md',
                data: {iframeSrc: this.modalSrc, heightIframeCss: 'h-64'}
            };
        },
        converOneQoutes(object)
        {
            return object.replace(/\'/g, '"');
        },
        getDetail()
        {
            let detail = JSON.parse(this.converOneQoutes(this.biblioDetail));
            return detail;
        }
    },
    mounted()
    {
    }
}